<?php

namespace App\Services\GitLab;

use App\Services\Git;
use App\Services\IGit;

class GitLab extends Git implements IGit
{
    public $uri = 'https://gitlab.com/api/v4/';

    public function list(): array
    {
        $header = ['PRIVATE-TOKEN', env('GITLAB_TOKEN')];
        $res = $this->apiCall('GET', 'projects/', '', $header);

        $body = $res->getBody();

        return json_decode($body->getContents());
    }
}
