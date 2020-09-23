<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class PostController extends Controller
{

	public function show() {
		try {
			$user = auth()->userOrFail();
		} catch (UserNotDefinedException $jwte) {
			return response()->json(['gg'=>$jwte->getMessage()]);
		}
		return $user->posts;
	}
}
