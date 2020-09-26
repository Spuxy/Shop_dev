<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function me(Request $r)
    {
        return response()->json(['success' => true, 'data' => auth()->userOrFail()]);
    }
}
