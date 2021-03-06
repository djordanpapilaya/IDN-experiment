<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sessions;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
	public $userToken = '';
	public $firstname = '';
	public $lastname = '';

	/**
	 * Display the registration view.
	 *
	 * @return \Illuminate\View\View
	 */

	public function create()
	{
		if (!request()->id) {
			return view('auth.login');
		}

		$this->userToken = request()->id;

		if (request()->firstname) {
			$this->firstname = request()->firstname;
		}

		if (request()->lastname) {
			$this->lastname = request()->lastname;
		}

//		dd(request()->id, request()->firstname, request()->lastname);
		return view('auth.register')->with(array('usertoken'=>$this->userToken,'firstName'=>$this->firstname,'lastName'=>$this->lastname));
	}

	public function createSession(Request $request)
	{
		$sessionObj = new Sessions;

		$user_id = \Auth::user()->id;
		$ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
		$agent = $request->server('HTTP_USER_AGENT');
		$current_time = \Carbon\Carbon::now()->timestamp;

		$sessionObj::create([
			'user_id' => $user_id,
			'ip_address' => $ip,
			'user_agent' => $agent,
			'start_time' => $current_time,
		]);
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$request->validate([
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|confirmed|min:8',
			'user_token' => 'string|max:255',
		]);

		$user = User::create([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'user_token' => $request->user_token,
		]);

		event(new Registered($user));

		Auth::login($user);

		$this->createSession($request);

		return redirect(RouteServiceProvider::HOME);
	}
}
