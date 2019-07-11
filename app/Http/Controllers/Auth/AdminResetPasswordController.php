<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\PasswordBrokerFactory;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Auth\Passwords;
use Illuminate\Support\Str;

class AdminResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin');
    }

    protected function guard() {
        return Auth::guard('admin');
    }

    protected function broker() {
        return Password::broker('admins');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('auth.passwords.admin_reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }

    protected function resetPassword($user, $password) {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();
    }

}
