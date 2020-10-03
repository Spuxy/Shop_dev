<?php

use App\Services\GitHub\GitHub;
use PHPUnit\Framework\TestCase;

class GitHubServiceTest extends TestCase
{

    public function test_fetching_list()
    {
        $guzzle = $this->createMock(GuzzleHttp\Client::class, [
            'base_uri' => 'https://api.github.com', [
                'auth' =>
                ['Spuxy', env('GITHUB_TOKEN')]
            ],
            'headers' => [
                'User-Agent' => ''
            ]
        ])->expects($this->once())
            ->method('get')
            ->with('/users/Spuxy/repos')->willReturn();
        $data = $guzzle->get();
        // $service = new GitHub();
        // $data = $service->list();
        $this->assertIsArray($data);
    }
}
