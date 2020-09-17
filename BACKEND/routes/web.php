<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wtf', function () {
    $data = [
        'event'=>'startchat',
	    'data' => [
	    	'username' => 'john doe'
	    ]
    ];
//    Redis::set('test',2);
//    return Redis::get('test');
	Redis::publish('test-channel', json_encode($data));
//	$wtf = new Predis\Client('tcp://127.0.0.1:6378');
//	$wtf->publish('test-channel', json_encode($data));
	return 'hotobo babicko';
});
