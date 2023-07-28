<?php

use App\Phases\HelloPhase;
use App\Phases\HelloWorldPhase;
use App\Phases\ShowParamPhase;
use App\Phases\WorldPhase;
use App\Pipelines\HelloWorldPipeline;

// Phases can be passed in directly as an array...
$r->addRoute('GET', '/phases', [HelloPhase::class, WorldPhase::class, HelloWorldPhase::class]);
// ...or as a pipeline
$r->addRoute('GET', '/pipeline', HelloWorldPipeline::class);

// They can accept parameters
$r->addRoute('GET', '/params/{name}', [ShowParamPhase::class]);