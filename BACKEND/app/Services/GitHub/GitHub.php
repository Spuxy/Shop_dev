<?php

namespace App\Services\GitHub;

use App\Services\IGit;
use App\Services\GitHub\Definitions\HEADER;
use App\Services\Git;
use Illuminate\Http\JsonResponse;
use stdClass;

class GitHub extends Git implements IGit
{
	protected $baseUri;
	protected $uri = 'https://api.github.com/';

	public function list(): array
	{
		$base = ['Spuxy', env('GITHUB_TOKEN')];

		$res = $this->apiCall('GET', 'users/Spuxy/repos', $base);

		$body = $res->getBody();

		return json_decode($body->getContents());
	}

	public function getLanguagesByRepository($repo): stdClass
	{
		$base = ['Spuxy', env('GITHUB_TOKEN')];

		$res = $this->apiCall('GET', "repos/Spuxy/{$repo}/languages", $base);

		$body = $res->getBody();

		return json_decode($body->getContents());
	}

	public function info()
	{
		$res = $this->client->get('/users/Spuxy');
		$headerRESET = $res->getHeader(HEADER::RESET);
		$headerLIMIT = $res->getHeader(HEADER::LIMIT);
		$headerREMAINING = $res->getHeader(HEADER::REMAINING);

		return [
			'limit_requests'     => $headerLIMIT,
			'requests_remaining' => $headerREMAINING,
			'requests_reset'     => $headerRESET
		];
	}
}
