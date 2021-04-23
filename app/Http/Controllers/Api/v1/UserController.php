<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$data = Resource::all()->toArray();

		return $data;
	}
}
