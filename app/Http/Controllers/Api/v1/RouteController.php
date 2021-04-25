<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\RouteEvents;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function store(Request $request) {
    	$route = new RouteEvents;

//	    'session_id',
//		'resource_id',
//		'user_id',
//		'times_visited',

	    if (\Auth::user()) {
		    $user_id = \Auth::user()->id;
		    $session = $request->session()->get('id');
	    }
//	    $this->getTimesVisited($request['resource_id'], $user_id);

	    $route::create([
		    'session_id' => $session,
		    'user_id' => $user_id,
		    'resource_id' => $request['resource_id'],
		    'times_visited' => $this->getTimesVisited($request['resource_id'], $user_id) + 1,
	    ]);

	    return response()->json(['ok'], 201);
    }

    public function getTimesVisited($resourceId, $userId) {
    	return count(RouteEvents::all()->where('resource_id', $resourceId)->where('user_id', $userId));
    }
}
