<?php

namespace Phase\Http\Route;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Phase\Http\Pipeline\Pipeline;

/**
 * Router is a simple wrapper around FastRoute. It's not very sophisticated, but it will do for now!
 */
class Router
{
    private Dispatcher $dispatcher;

    public function __construct(string $pathToRoutes)
    {
        $this->dispatcher = simpleDispatcher(function (RouteCollector $r) use ($pathToRoutes)
        {
            require $pathToRoutes;
        });
    }

    public function dispatch(Request $request): Response
    {
        $routeInfo = $this->dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
        $response;
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // TODO: Implement this
                die('Not found');
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // TODO: Implement this
                die('Method not allowed');
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
        
                if (is_array($handler))
                {
                    // For now, just assume an array means phases
                    $pipeline = new Pipeline;
                    $pipeline->addAll($handler);
                    $response = $pipeline->run($request);
                }
                else
                {
                    // Anything else is assumed to be a pipeline
                    $response = (new $handler)->run($request);
                }
                break;
        }

        return $response;
    }
}