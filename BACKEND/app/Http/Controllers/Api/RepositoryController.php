<?php

namespace App\Http\Controllers\Api;

use App\Services\Cache\Redis;
use App\Services\GitHub\GitHub;
use App\Http\Controllers\Controller;
use App\Services\Factory\GitFactory;

class RepositoryController extends Controller
{

	protected $client;
	/**
	 * @var Redis
	 */

	public function __construct(GitHub $client)
	{
		//		$this->middleware('auth:api');
		$this->client = $client;
	}

	// zobrazit jazyky a repositare daneho uzivatele
	public function index($platForm)
	{
		$factory = new GitFactory();

		$git = $factory->make($platForm);

		return response()->json(['success' => TRUE, 'data' => [
			$git->list()
		]]);
	}
}
