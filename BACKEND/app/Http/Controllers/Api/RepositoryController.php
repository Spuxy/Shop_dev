<?php

namespace App\Http\Controllers\Api;

use App\Models\Repository;
use App\Services\GitHub\GitHub;
use App\Http\Controllers\Controller;
use App\Services\Factory\GitFactory;

class RepositoryController extends Controller
{

	/**
	 * returns list of branches
	 *
	 * @param  string $platForm
	 * @return json 
	 */
	public function index($platForm)
	{
		$factory = new GitFactory();
		$git = $factory->make($platForm);
		return response()->json(['success' => TRUE, 'data' => [
			$git->list()
		]]);
	}

	public function store(Repository $repositoriy)
	{
	}
}
