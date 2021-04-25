<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Sessions;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
	/**
	 * Display the login view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return view('auth.login');
	}

	/**
	 * Handle an incoming authentication request.
	 *
	 * @param \App\Http\Requests\Auth\LoginRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		$this->createSession($request);

		return redirect()->intended(RouteServiceProvider::HOME);
	}

	public function createSession(LoginRequest $request)
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

	public function showDestroy(Request $request)
	{
		$this->closeSession($request);

		Auth::guard('web')->logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}

	/**
	 * Destroy an authenticated session.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Request $request)
	{
		$this->closeSession($request);

		Auth::guard('web')->logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}

	public function closeSession(Request $request)
	{
		$user_id = \Auth::user()->id;

		$current_time = \Carbon\Carbon::now()->timestamp;

		$sessionObj = Sessions::where('user_id', $user_id)
			->where('end_time', '=', null)
			->update(['end_time' => $current_time]);

	}
}
