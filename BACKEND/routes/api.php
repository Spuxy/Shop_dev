<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\RepositoryController;
use Mockery\Generator\StringManipulation\Pass\Pass;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');

// Github call pres api.php
// presun pote do routes/github/api.php
// Pouzit postman
Route::group(['prefix' => 'git'], function () {
    // zobrazi list repositorau daneho uzivatele
    Route::get("repo/list/{platForm}", [RepositoryController::class, 'index']);
    Route::get('request/info', [RepositoryController::class, 'info']);
    Route::get('repo/{repository}', [RepositoryController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('me', [AdminController::class, 'me']);
    Route::get('logout', [LogoutController::class, 'logout']);
});

Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
});
