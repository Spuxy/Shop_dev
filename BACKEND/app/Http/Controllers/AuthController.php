<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login']]);
	}

	public function login(Request $r)
	{
		$c = $r->only('email', 'password');

		if (!$token = JWTAuth::attempt($c)) {
			return response()->json(['not found'], 401);
		}

		return response()->json(['token' => $token]);
	}

	protected function respondWithToken($token)
	{
	}

	public function checkJWT()
	{
		return response()->json(['success' => true], 200);
	}

	public function guard()
	{
		return Auth::guard();
	}
}
