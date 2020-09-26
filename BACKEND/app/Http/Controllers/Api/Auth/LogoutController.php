<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{

    public function __construct()
    {
    }

    public function logout()
    {
        if (!auth()->user()) {
            return response()->json(['u are not registred'], 401);
        }
        auth()->invalidate();
        return response()->json(['success' => true, 'logout' => true], 200);
    }
}
