<?php


namespace App\Services\Cache;


use Illuminate\Http\Request;

interface ICachaeble {

	public function get(Request $request) : string;
}