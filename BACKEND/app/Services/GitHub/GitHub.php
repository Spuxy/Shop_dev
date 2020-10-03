<?php

namespace App\Services\GitHub;

use App\Services\IGit;
use GuzzleHttp\Client;
use App\Services\GitHub\Definitions\HEADER;

class GitHub implements IGit
{
	protected $client;

	public function __construct()
	{
		$this->client = new Client([
			'base_uri' => 'https://api.github.com', [
				'auth' =>
				['Spuxy', env('GITHUB_TOKEN')]
			],
			'headers' => [
				'User-Agent' => ''
			]
		]);
	}

	public function list(): array
	{
		$res = $this->client->get('/users/Spuxy/repos');
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
