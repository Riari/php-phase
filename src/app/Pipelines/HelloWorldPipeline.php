<?php

namespace App\Pipelines;

use App\Phases\ReadHelloWorld;
use App\Phases\WriteHello;
use App\Phases\WriteWorld;
use Phase\Http\Pipeline\Pipeline;

class HelloWorldPipeline extends Pipeline
{
    public function __construct()
    {
        $this->addAll([WriteHello::class, WriteWorld::class, ReadHelloWorld::class]);
    }
}