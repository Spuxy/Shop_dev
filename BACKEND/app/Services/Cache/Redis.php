<?php


namespace App\Services\Cache;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class Redis implements ICachaeble {

	public function get(Request $r) : string {
		if ($alreadyCreated = \Illuminate\Support\Facades\Redis::get($r->input('email'))){
			$token = $alreadyCreated;
		} else {
			$token = JWTAuth::attempt($r->only('email', 'password'));
		}
		return $this->isValid($token);
	}

	private function isValid($t) {
		if (!$t) {
			return response()->json(['error' => [
				'credentionals' => [
					'error' => 'invalid password or email'
				]
			]]);
		}

		return TRUE;
	}
}