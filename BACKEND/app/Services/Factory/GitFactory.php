<?php

namespace App\Services\Factory;

use App\Services\IGit;

class GitFactory
{

    protected $gits = [
        'github' => 'GitHub',
        'gitlab' => 'GitLab',
    ];


    /**
     * create class depends on url param
     *
     * @param  string $name
     * @return IGit
     */
    public function make($name): IGit
    {
        $git = $this->gits[$name] ?: $name;
        $class = "App\\Services\\$git\\$git";
        return new $class;
    }
}
