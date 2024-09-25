<?php

namespace App\Http\Requests\Auth;

use App\Models\Company;
use App\Models\FirebaseToken;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Retrieve the authenticated user
        $authenticatedUser = Auth::user();

        // Check if the user can login based on additional conditions
        if (! $this->userCanLogin($authenticatedUser)) {
            Auth::logout(); // Logout the user

            session()->flush(); // Clear all session data
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'error' => "You cannot login to your account. Contact Admin!",
            ]);
        }

        // Retrieve the company associated with the authenticated user
        $company = Company::withTrashed()->where('id', $authenticatedUser->company_id)->first();

        // Check if the company is soft-deleted (deleted_at is not null)
        if ($company && $company->trashed()) {
            Auth::logout(); // Logout the user

            session()->flush(); // Clear all session data
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'error' => "Your company is disabled. Contact Admin for more details.",
            ]);
        }

        // Set session variables
        session(['company' => $company]);

        // Save the FCM token
        if ($this->has('fcm_token') && $this->input('fcm_token')) {
            FirebaseToken::updateOrCreate(
                ['user_id' => $authenticatedUser->id, 'fcm_token' => $this->input('fcm_token')],
                ['ip_address' => request()->ip()]
            );
            session(['fcm_token' => $this->input('fcm_token')]);
        }

        RateLimiter::clear($this->throttleKey());
    }


    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Check if the user can login based on additional conditions.
     *
     * @return bool
     */
    protected function userCanLogin($user)
    {
        // Check if the user object is null
        if (! $user) {
            return false;
        }

        return true;
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
