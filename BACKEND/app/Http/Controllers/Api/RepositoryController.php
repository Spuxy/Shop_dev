<?php

namespace App\Http\Controllers\Api;

use App\Resources\GitHubResource;
use App\Services\GitHub\GitHub as GitHubService;
use App\Models\Repository;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Services\Cache\Redis;

class RepositoryController extends Controller
{

    protected $gitHub;
	/**
	 * @var Redis
	 */
	private $redis;

	public function __construct(GitHubService $gitHub, Redis $redis) {
//		$this->middleware('auth:api');
		$this->gitHub = $gitHub;
		$this->redis = $redis;
	}


    public function index()
    {
    	$data = Repository::all();
        return GitHubResource::collection($data);
    }

	public function info(Request $request) {
		try {
			$this->redis->get($request);
		} catch (JWTException $e) {
			response()->json([
				'error' => $e->getMessage()
			]);
		}
		return response()->json(['success'=>TRUE, 'data' => [
			$this->gitHub->info()
		]]);
    }
}
