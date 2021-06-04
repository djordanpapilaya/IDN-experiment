<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Sessions;
use App\Models\User;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$data = Resource::all();

		return $data;
	}

	public function allUsers(Request $request)
	{
		$data = User::all();

		return $data;
	}

	public function userData(Request $request)
	{
		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$userSessions = Sessions::where('user_id', $user_id)
			->get();

		$userData = User::where('id', $user_id)
			->get();

		$userFirstTime = \sizeof($userSessions) <= 1;

		foreach ($userData as $data)
		{
			$firstName = $data->first_name;
			$lastName = $data->last_name;
			$email = $data->email;
		}

		return response()->json([
			'firstSession' => $userFirstTime,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
		]);
	}

	public function sessionTime(Request $request)
	{
		$totalTime = 0;
//		TODO SET CORRECT NUMB OF MINUTES
		$experimentTimeMinutes = 240;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$userSessions = Sessions::where('user_id', $user_id)
			->get();

		foreach ($userSessions as $item) {
			if ($item->total_time !== null) {
				$totalTime += $item->total_time;
			} else {
				$totalTime += 0;
			}

//			if ($item->end_time !== null) {
//				$startTime = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $this->getCreatedAtAttribute($item->start_time));
//				$endTime = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $this->getCreatedAtAttribute($item->end_time));
//				$diff_in_minutes = $endTime->diffInMinutes($startTime);
//
//				$totalTime += $diff_in_minutes;
//			}
		}

		if ($experimentTimeMinutes - $totalTime < 0) {
			$timesLeft = 0;
		} else {
			$timesLeft = $experimentTimeMinutes - $totalTime;
		}

		return response()->json(['experiment_time' => $experimentTimeMinutes, 'total_time' => $totalTime, 'remaining_time' => $timesLeft], 201);
	}

	public function getCreatedAtAttribute($timestamp)
	{
		$time = new \DateTime();
		$time->setTimestamp($timestamp);
		return \Carbon\Carbon::parse($time)->format('Y-m-d H:s:i');
	}

	public function setUserSession(Request $request)
	{
		$session_time = 0;
		$current_timestamp = \Carbon\Carbon::now()->timestamp;

		if (\Auth::user()) {
			$user_id = \Auth::user()->id;
		} else {
//			ONLY FOR TESTING PURPOSES IN DEV ENV
			$user_id = 1;
		}

		$userSessions = Sessions::where('user_id', $user_id)
			->orderBy('id', 'DESC')
			->first();

		if ($userSessions->total_time !== null) {
			$session_time = $userSessions->total_time;
		} else {
			$session_time = 0;
		}

		$session_time += 1;

		$userSessions->end_time = $current_timestamp;
		$userSessions->total_time = $session_time;

		$userSessions->save();
	}
}
