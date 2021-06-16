<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Models\User;
use App\Rules\Captcha;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class LoginController.
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(homeRoute());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }

        return view('frontend.auth.login');
    }

    public function showUserLoginForm()
    {
        if (Auth::check()) {
            return redirect('/voting');
        }

        return view('frontend.auth.login_user');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        if($request->has('pin')) {
            $request->validate([
                'pin'=> ['required'],
            ]);
        } else {
            $request->validate([
                $this->username() => ['required', 'max:255', 'string'],
                'password' => array_merge(['max:100'], PasswordRules::login()),
                'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
            ], [
                'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
            ]);
        }
    }

    /**
     * Overidden for 2FA
     * https://github.com/DarkGhostHunter/Laraguard#protecting-the-login.
     *
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        if($request->has('pin')) {
            $user = User::where('pin', $request->pin)->first();
            if(!empty($user)) {
                Auth::loginUsingId($user->id, true);
                return redirect('voting');
            }
        }
        try {
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        } catch (HttpResponseException $exception) {
            $this->incrementLoginAttempts($request);
            return redirect()->back()->withErrors(['error', 'your message,here']);
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user) {
            if (!$user->isActive()) {
                auth()->logout();
                return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
            }
            event(new UserLoggedIn($user));
            if (config('boilerplate.access.user.single_login')) {
                auth()->logoutOtherDevices($request->password);
            }
        } else {
            redirect()->back();
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}
