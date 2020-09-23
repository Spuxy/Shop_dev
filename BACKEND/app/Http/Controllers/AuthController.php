<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function __construct() {
		$this->middleware('auth:api', ['except' => ['login']]);
	}

	public function login(Request $r) {
		$c = $r->only('email', 'password');

		if (! $token = $this->guard()->attempt($c)) {
			return response()->json(['not found'],401);
		}

		return response()->json(['token' => $token]);
	}

	protected function respondWithToken($token)
	{

	}

	public function guard()
	{
		return Auth::guard();
	}
}
