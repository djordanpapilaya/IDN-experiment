<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AudioEvents;
use App\Models\Resource;
use App\Models\Sessions;
use App\Models\TextEvents;
use App\Models\TimeEvents;
use App\Models\VideoEvents;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
	public function index()
	{
		$data = Resource::all();

		$newData = $data->map(function ($item, $key) {
			$item->short = Str::limit($item->title, 50);

			return $item;
		});

		return response($newData)
			->header('Access-Control-Allow-Origin', '*');
	}

	public function show(\App\Models\Resource $resource)
	{
		$resource->short = Str::limit($resource->title, 50);

		return response($resource)
			->header('Access-Control-Allow-Origin', '*');
	}

	public function storeText(Request $request)
	{
		$textModel = new TextEvents;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$textModel::create([
			'session_id' => $this->getSession($user_id),
			'user_id' => $user_id,
			'resource_id' => $request['resource_id'],
			'page_visit' => $request['page_visit'],
		]);

		return response()->json(['ok'], 201);
	}

	public function storeVideo(Request $request)
	{
		$videoModel = new VideoEvents;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$videoModel::create([
			'session_id' => $this->getSession($user_id),
			'user_id' => $user_id,
			'resource_id' => $request['resource_id'],
			'start_time' => gmdate("H:i:s", $request['start_time']),
			'end_time' => gmdate("H:i:s", $request['end_time']),
			'sequence_time' => gmdate("H:i:s", $request['sequence_time']),
		]);

		return response()->json(['ok'], 201);
	}

	public function storeAudio(Request $request)
	{
		$audioModel = new AudioEvents;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$audioModel::create([
			'session_id' => $this->getSession($user_id),
			'user_id' => $user_id,
			'resource_id' => $request['resource_id'],
			'start_time' => gmdate("H:i:s", $request['start_time']),
			'end_time' => gmdate("H:i:s", $request['end_time']),
			'sequence_time' => gmdate("H:i:s", $request['sequence_time']),
		]);

		return response()->json(['ok'], 201);
	}

	public function storeTime(Request $request)
	{
		$timeModel = new TimeEvents;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$startTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request['time_started']);
		$endTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request['time_ended']);
		$diff_in_seconds = $endTime->diffInRealSeconds($startTime);

		$totalTime = gmdate("H:i:s", $diff_in_seconds);

		$timeModel::create([
			'session_id' => $this->getSession($user_id),
			'user_id' => $user_id,
			'resource_id' => $request['resource_id'],
			'time_started' => $request['time_started'],
			'time_ended' => $request['time_ended'],
			'total_time' => $totalTime,
		]);

		return response()->json(['ok'], 201);
	}

	public function getCreatedAtAttribute($timestamp)
	{
		$time = new \DateTime();
		return \Carbon\Carbon::parse($time)->format('Y-m-d H:s:i');
	}

	public function getSession($user_id)
	{
		$userSessions = Sessions::where('user_id', $user_id)
			->orderBy('id', 'DESC')
			->first();

		return $userSessions->id;
	}
}
