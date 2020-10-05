<?php

return [
    'github' => [
        'url' => 'https://api.github.com/',
        'token' => env('GITHUB_TOKEN', ''),
    ],
    'gitlab' => [
        'url' => 'https://gitlab.com/api/v4/',
        'token' => env('GITLAB_TOKEN', ''),
    ]
];
