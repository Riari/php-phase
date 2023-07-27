<?php

namespace Phase\App;

use Symfony\Component\HttpFoundation\Request;

use Phase\Config\Config;
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
        $response = $this->router->dispatch(Request::createFromGlobals());
        $response->send();
    }
}