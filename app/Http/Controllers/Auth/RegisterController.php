<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');

        $this->randomNumber = $this->random_strings(10);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'email_token' => $this->randomNumber
        ]);
    }

    /*
     * function override to avoid redirection
     */

    public function register(Request $request) {

        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        //$this->guard()->login($user);
        // send verification email 
        $formData = $request->all();
        $user = array('first_name' => $formData['first_name'], 'last_name' => $formData['last_name'], 'email' => $formData['email'], 'randomNumber' => $this->randomNumber);
        Mail::to($user['email'])->send(new VerificationMail($user));

        return redirect()->route('login')->with('message', 'Please check and verify your email');

//        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    /*
     * generate random number
     */

    function random_strings($length_of_string) {

        // md5 the timestamps and returns substring 
        // of specified length 
        return substr(md5(time()), 0, $length_of_string);
    }

}
