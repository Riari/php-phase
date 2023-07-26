<?php

require __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Phases\HelloPhase;
use App\Phases\WorldPhase;
use App\Phases\HelloWorldPhase;
use App\Pipelines\HelloWorldPipeline;
use Phase\Http\Pipeline\Pipeline;

// TODO: Extract framework logic from this file
// TODO: Update to include some routes with URI parameters

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // Phases can be passed in directly as an array...
    $r->addRoute('GET', '/phases', [HelloPhase::class, WorldPhase::class, HelloWorldPhase::class]);
    // ...or as a pipeline
    $r->addRoute('GET', '/pipeline', HelloWorldPipeline::class);
});

$request = Request::createFromGlobals();

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        if (is_array($handler))
        {
            // For now, just assume an array means phases
            $pipeline = new Pipeline;
            $pipeline->addAll($handler);
            $response = $pipeline->run($request);
            $response->send();
        }
        else
        {
            // Anything else is assumed to be a pipeline
            $response = (new $handler)->run($request);
            $response->send();
        }
        break;
}