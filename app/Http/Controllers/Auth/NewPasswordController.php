<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        addJavascriptFile('assets/js/custom/authentication/reset-password/new-password.js');

        return view('pages/auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'password_plain' => $request->password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Handle success or failure cases
        if ($status == Password::PASSWORD_RESET) {
            // If AJAX, return JSON for success
            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => __('Password has been reset successfully.')]);
            }

            // Redirect to login if it's not an AJAX request
            return redirect()->route('login')->with('status', __($status));
        }

        // Handle errors
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => [trans($status)],
            ], 422); // Send validation error status
        }

        // Redirect back with error messages for non-AJAX requests
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => __($status)]);
    }
}
