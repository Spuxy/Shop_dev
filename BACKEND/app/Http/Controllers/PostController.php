<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class PostController extends Controller
{
	public function __construct() {
		$this->middleware('auth:api')->except('test');
	}
	public function list() {
		return Post::all();
	}
	public function show() {
		try {
			$user = auth()->userOrFail();
		} catch (UserNotDefinedException $jwte) {
			return response()->json(['gg'=>$jwte->getMessage()]);
		}
		return $user->posts;
	}
	public function test() {
		return 'hello world';
	}
}
