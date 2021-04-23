<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
	public function index()
	{
		$data = Resource::all();

		return $data;
	}
	public function show(\App\Models\Resource $resource)
	{
		return $resource;
	}
}
