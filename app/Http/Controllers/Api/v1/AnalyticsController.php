<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AudioEvents;
use App\Models\Resource;
use App\Models\ResourcesExtended;
use App\Models\RouteEvents;
use App\Models\Sessions;
use App\Models\TextEvents;
use App\Models\TimeEvents;
use App\Models\User;
use App\Models\VideoEvents;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;

class AnalyticsController extends Controller
{
	public function allResources()
	{
		$data = ResourcesExtended::all();

		return $data;
	}

	public function getAllUserData(Request $request)
	{
		$users = User::all();

		$totalSessions = 0;
		$totalTime = 0;
		$totalUsers = $users->count();
		$totalUserTime = 0;

		$usersInSession = Sessions::select('user_id')
			->distinct()
			->get();

		$numberOfUsersInSession = $usersInSession->count();

		foreach ($users as $user)
		{
			$user_id = $user->id;

			$userSessions = Sessions::where('user_id', $user_id)
				->get();

			$numberOfSession = $userSessions->count();
			$totalSessions += $numberOfSession;
			$userTotalSessionTime = 0;

			foreach ($userSessions as $userSession)
			{
				$totalTime += $userSession->total_time;
				$userTotalSessionTime += $userSession->total_time;
			}

			$totalUserTime += $userTotalSessionTime;
		}

		return ['avg_time_per_session' => $totalTime / $totalSessions, 'avg_time_per_user' => $totalUserTime / $numberOfUsersInSession];

	}

	public function getUserData(Request $request)
	{
		$user_id = $request->id;

		$userSessions = Sessions::where('user_id', $user_id)
			->get();

		$userData = User::where('id', $user_id)
			->get();

		$numberOfSession = $userSessions->count();

		$userInfo = [
			'userToken' => $userData[0]->user_token,
			'firstName' => $userData[0]->first_name,
			'lastName' => $userData[0]->last_name,
			'email' => $userData[0]->email,
		];

		$routeEventsUser = RouteEvents::where('user_id', $user_id)
			->get();

		$timesUser = TimeEvents::where('user_id', $user_id)
			->get();
		
		$userStats = [
			'numb_of_sources' => count($routeEventsUser),
			'political_progressive'=> 0,
			'political_conservative'=> 0,
			'political_center'=> 0,
			'form_simple'=> 0,
			'form_medium'=> 0,
			'form_complex'=> 0,
			'content_simple'=> 0,
			'content_medium'=> 0,
			'content_complex'=> 0,
			'type_text' => 0,
			'type_video' => 0,
			'type_audio' => 0,
			'total_time' => $this->calcTotalTime($timesUser),
			'average_time' => $this->calcAvgTime($timesUser),
		];

		$resourcesUserList = [];

		$resourceIdPath = '';
		$politicalPath = '';
		$complexityPath = '';
		$typePath = '';

		foreach ($routeEventsUser as $item)
		{
			$resourceId = $item->resource_id;
			
			$resources = ResourcesExtended::where('id', $resourceId)
				->get();

			$resourcesBasic = Resource::where('id', $resourceId)
				->get();

			$resourceData = [
				'id' => $resources[0]->id,
				'title'=> $resources[0]->title,
				'copy'=> $resources[0]->copy,
				'type'=> $resources[0]->type,
				'political'=> $resources[0]->political,
				'belief'=> $resources[0]->belief,
				'content'=> $resources[0]->content,
				'form'=> $resources[0]->form,
			];

			$resourceIdPath = $resourceIdPath . $resources[0]->id . '-';

			if ($resources[0]->political === 'progressive') $politicalPath = $politicalPath . 'P-';
			if ($resources[0]->political === 'conservative') $politicalPath = $politicalPath . 'C-';
			if ($resources[0]->political === 'center') $politicalPath = $politicalPath . 'M-';

			if ($resources[0]->content === 'Simple') $complexityPath = $complexityPath . 'S-';
			if ($resources[0]->content === 'Complex') $complexityPath = $complexityPath . 'C-';
			if ($resources[0]->content === 'Medium') $complexityPath = $complexityPath . 'M-';

			if ($resourcesBasic[0]->type === 'text') $typePath = $typePath . 'T-';
			if ($resourcesBasic[0]->type === 'video') $typePath = $typePath . 'V-';
			if ($resourcesBasic[0]->type === 'audio') $typePath = $typePath . 'A-';

			if ($resources[0]->political === 'progressive') $userStats['political_progressive'] +=1;
			if ($resources[0]->political === 'conservative') $userStats['political_conservative'] +=1;
			if ($resources[0]->political === 'center') $userStats['political_center'] +=1;
			if ($resources[0]->content === 'Simple') $userStats['content_simple'] +=1;
			if ($resources[0]->content === 'Complex') $userStats['content_complex'] +=1;
			if ($resources[0]->content === 'Medium') $userStats['content_medium'] +=1;
			if ($resources[0]->form === 'Simple') $userStats['form_simple'] +=1;
			if ($resources[0]->form === 'Medium') $userStats['form_medium'] +=1;
			if ($resources[0]->form === 'Complex') $userStats['form_complex'] +=1;
			if ($resourcesBasic[0]->type === 'text') $userStats['type_text'] +=1;
			if ($resourcesBasic[0]->type === 'video') $userStats['type_video'] +=1;
			if ($resourcesBasic[0]->type === 'audio') $userStats['type_audio'] +=1;

			array_push($resourcesUserList, $resourceData);
		}

		$userData = [
			'stats'=> $userStats,
			'paths' => [
				'resource' => $resourceIdPath,
				'political' => $politicalPath,
				'complexity' => $complexityPath,
				'type' => $typePath,
			],
			'watched'=> $resourcesUserList
		];

		$sessions = [];

		foreach ($userSessions as $session)
		{
			$routeEvents = RouteEvents::where('session_id', $session->id)
				->get();

			$timesSession = TimeEvents::where('session_id', $session->id)
				->get();

			$resourcesList = [];
			$resourceIdPathSession = '';
			$politicalPathSession = '';
			$complexityPathSession = '';
			$typePathSession = '';

			$stats = [
				'numb_of_sources' => count($routeEvents),
				'political_progressive'=> 0,
				'political_conservative'=> 0,
				'political_center'=> 0,
				'form_simple'=> 0,
				'form_medium'=> 0,
				'form_complex'=> 0,
				'content_simple'=> 0,
				'content_medium'=> 0,
				'content_complex'=> 0,
				'type_text' => 0,
				'type_video' => 0,
				'type_audio' => 0,
				'total_time' => $this->calcTotalTime($timesSession),
				'average_time' => $this->calcAvgTime($timesSession),
			];

			foreach ($routeEvents as $routeEvent)
			{
				$resourceId = $routeEvent->resource_id;

				$resources = ResourcesExtended::where('id', $resourceId)
					->get();

				$resourcesSessionBasic = Resource::where('id', $resourceId)
					->get();

				$resourceData = [
					'id' => $resources[0]->id,
					'title'=> $resources[0]->title,
					'copy'=> $resources[0]->copy,
					'type'=> $resources[0]->type,
					'political'=> $resources[0]->political,
					'belief'=> $resources[0]->belief,
					'content'=> $resources[0]->content,
					'form'=> $resources[0]->form,
				];

				$resourceIdPathSession = $resourceIdPathSession . $resources[0]->id . '-';

				if ($resources[0]->political === 'progressive') $politicalPathSession = $politicalPathSession . 'P-';
				if ($resources[0]->political === 'conservative') $politicalPathSession = $politicalPathSession . 'C-';
				if ($resources[0]->political === 'center') $politicalPathSession = $politicalPathSession . 'M-';

				if ($resources[0]->content === 'Simple') $complexityPathSession = $complexityPathSession . 'S-';
				if ($resources[0]->content === 'Complex') $complexityPathSession = $complexityPathSession . 'C-';
				if ($resources[0]->content === 'Medium') $complexityPathSession = $complexityPathSession . 'M-';

				if ($resourcesSessionBasic[0]->type === 'text') $typePathSession = $typePathSession . 'T-';
				if ($resourcesSessionBasic[0]->type === 'video') $typePathSession = $typePathSession . 'V-';
				if ($resourcesSessionBasic[0]->type === 'audio') $typePathSession = $typePathSession . 'A-';

				if ($resources[0]->political === 'progressive') $stats['political_progressive'] +=1;
				if ($resources[0]->political === 'conservative') $stats['political_conservative'] +=1;
				if ($resources[0]->political === 'center') $stats['political_center'] +=1;
				if ($resources[0]->content === 'Simple') $stats['content_simple'] +=1;
				if ($resources[0]->content === 'Complex') $stats['content_complex'] +=1;
				if ($resources[0]->content === 'Medium') $stats['content_medium'] +=1;
				if ($resources[0]->form === 'Simple') $stats['form_simple'] +=1;
				if ($resources[0]->form === 'Medium') $stats['form_medium'] +=1;
				if ($resources[0]->form === 'Complex') $stats['form_complex'] +=1;
				if ($resourcesSessionBasic[0]->type === 'text') $stats['type_text'] +=1;
				if ($resourcesSessionBasic[0]->type === 'video') $stats['type_video'] +=1;
				if ($resourcesSessionBasic[0]->type === 'audio') $stats['type_audio'] +=1;


				array_push($resourcesList, $resourceData);
			}

			$sessionItem = [

				'id' => $session->id,
				'userId' => $session->user_id,
				'total_time' => $session->total_time,
				'user_agent' => $session->user_agent,
				'paths' => [
					'resource' => $resourceIdPathSession,
					'political' => $politicalPathSession,
					'complexity' => $complexityPathSession,
					'type' => $typePathSession,
				],
				'stats' => $stats,
				'watched' => $resourcesList,
			];

			array_push($sessions, $sessionItem);
		}
		return ['all' => $userData, 'sessions' => $sessions];
	}

	public function calcTotalTime(Collection $times)
	{
		if(count($times) > 0) {
			$total = 0;

			foreach ($times as $time) {
				$timeInSeconds = strtotime($time->total_time) - strtotime('TODAY');

				$total += $timeInSeconds;
			}

			return sprintf('%02d:%02d:%02d', ($total / 3600), ($total / 60 % 60), $total % 60);
		}

		return 0;
	}

	public function calcAvgTime(Collection $times)
	{
		if(count($times) > 0) {
			$total = 0;
			$length = count($times);

			foreach ($times as $time) {
				$timeInSeconds = strtotime($time->total_time) - strtotime('TODAY');

				$total += $timeInSeconds;
			}

			$average = $total / $length;

			return sprintf('%02d:%02d:%02d', ($average / 3600), ($average / 60 % 60), $average % 60);
		}

		return 0;
	}


}
