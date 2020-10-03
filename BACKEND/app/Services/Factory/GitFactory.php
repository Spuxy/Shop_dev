<?php

namespace App\Services\Factory;

use App\Services\IGit;

class GitFactory
{
    public function make($name): IGit
    {
        $class = "App\\Services\\{$name}\\{$name}";
        return new $class;
    }
}
