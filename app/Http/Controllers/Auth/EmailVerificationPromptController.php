<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Check if the email verification notification was already sent in this session
        if (!session()->has('verification-email-sent')) {
            // Send verification email
            $request->user()->sendEmailVerificationNotification();

            // Mark email as sent in session to avoid resending automatically
            session(['verification-email-sent' => true]);
        }

        return view('pages/auth.verify-email')->with('status', 'verification-link-sent');
    }
}
