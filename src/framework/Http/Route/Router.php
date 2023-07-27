<?php

namespace Phase\Http\Route;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function dispatch(Request $request): array
    {
        return $this->dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
    }
}