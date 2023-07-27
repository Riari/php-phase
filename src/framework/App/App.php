<?php

namespace Phase\App;

use FastRoute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;

use Phase\Config\Config;
use Phase\Http\Pipeline\Pipeline;
use Phase\Http\Route\Router;

class App
{
    private string $pathToApp;
    private Router $router;

    private const PATH_CONFIG = 'config/';
    private const PATH_ROUTES = 'routes/';

    public function __construct(string $pathToApp)
    {
        Config::init($pathToApp . self::PATH_CONFIG);
        $routesFile = Config::get('router.routes.web');
        $this->router = new Router($pathToApp . self::PATH_ROUTES . $routesFile);
    }

    public function run()
    {
        $request = Request::createFromGlobals();
        $routeInfo = $this->router->dispatch($request);

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
                $params = $routeInfo[2];
        
                if (is_array($handler))
                {
                    // For now, just assume an array means phases
                    $pipeline = new Pipeline;
                    $pipeline->addAll($handler);
                    $response = $pipeline->run($request, $params);
                }
                else
                {
                    // Anything else is assumed to be a pipeline
                    $response = (new $handler)->run($request, $params);
                }
                break;
        }

        $response->send();
    }
}