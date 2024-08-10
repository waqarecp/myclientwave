<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


use App\Models\LoginActivity;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/sign-in/general.js');

        return view('pages/auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();


        LoginActivity::create([
            'user_id' => Auth::id(),
            'status' => 'success',
            'device' => $request->header('User-Agent'),
            'ip_address' => $request->getClientIp(),
            'login_time' => Carbon::now(),
        ]);

        $request->user()->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {   LoginActivity::create([
        'user_id' => Auth::id(),
        'status' => 'Ended',
        'device' => $request->header('User-Agent'),
        'ip_address' => $request->getClientIp(),
        'login_time' => Carbon::now(),
    ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();
   

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
