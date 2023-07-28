<?php

use App\Phases\Blog\ReadPost;
use App\Phases\Blog\WritePost;
use App\Phases\ReadHelloWorld;
use App\Phases\ReadParam;
use App\Phases\WriteHello;
use App\Phases\WriteWorld;
use App\Pipelines\HelloWorldPipeline;

// Phases can be passed in directly as an array...
$r->addRoute('GET', '/phases', [WriteHello::class, WriteWorld::class, ReadHelloWorld::class]);
// ...or as a pipeline
$r->addRoute('GET', '/pipeline', HelloWorldPipeline::class);

// They can accept parameters
$r->addRoute('GET', '/params/{name}', [ReadParam::class]);

$r->addRoute('POST', '/blog', [WritePost::class]);
$r->addRoute('GET', '/blog/{id:\d+}', [ReadPost::class]);