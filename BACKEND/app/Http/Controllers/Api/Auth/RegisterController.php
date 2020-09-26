<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $r)
    {
        $res = $this->validateInputs($r);
        if ($res->fails()) {
            return response()->json(['success' => false], 422);
        }

        $c = request(['email', 'password']);

        $result = $this->create($r->all());

        $token = JWTAuth::attempt($c);

        return response()->json(['success' => true, 'data' => $result, 'token' => $token], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::perform($data);
    }

    public function registered(Request $request, User $user)
    {
        //    	TODO Response after registration some good UI and Event
        return response()->json(['User' => 'hasbeenregistredbro']);
    }

    public function validateInputs($r)
    {
        return Validator::make($r->all(), [
            'email' => 'required|email|unique:users',
            'username' => 'required|string|max:50',
            'password' => 'required'
        ]);
    }
}
