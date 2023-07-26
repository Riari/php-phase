<?php

namespace App\Pipelines;

use App\Phases\HelloPhase;
use App\Phases\HelloWorldPhase;
use App\Phases\WorldPhase;
use Phase\Http\Pipeline\Pipeline;

class HelloWorldPipeline extends Pipeline
{
    public function __construct()
    {
        $this->addAll([HelloPhase::class, WorldPhase::class, HelloWorldPhase::class]);
    }
}