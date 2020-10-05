<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class Git
{
    protected $client;

    public function apiCall($method, $endpoint, $base = [], $header = []): Response
    {
        $userName = $base[0];
        $token = $base[1];
        $client = new Client([
            'base_uri' => $this->uri,
            'auth' => [
                $userName,
                $token

            ],
            'headers' => $header
        ]);
        return $client->request($method, $endpoint);
    }
}
