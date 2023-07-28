<?php

namespace Phase\App;

use Illuminate\Database\Capsule\Manager as DatabaseManager;
use FastRoute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;

use Phase\Config\Config;
use Phase\Http\Pipeline\Pipeline;
use Phase\Http\Route\Router;

class App
{
    private readonly Router $router;
    private readonly DatabaseManager $dbManager;

    private const PATH_CONFIG = 'config/';
    private const PATH_ROUTES = 'routes/';

    public function __construct(string $pathToApp)
    {
        $this->initConfig($pathToApp);
        $this->initRouter($pathToApp);
        $this->initDatabase();
    }

    private function initConfig(string $pathToApp)
    {
        Config::init($pathToApp . self::PATH_CONFIG);
    }

    private function initRouter(string $pathToApp)
    {
        $routesFile = Config::get('router.routes.web');
        $this->router = new Router($pathToApp . self::PATH_ROUTES . $routesFile);
    }

    private function initDatabase()
    {
        $manager = new DatabaseManager;
        $connections = Config::get('database.connections');
        $default = Config::get('database.default_connection');
        $manager->addConnection($connections[$default]);
        $manager->setAsGlobal();
        $manager->bootEloquent();
        $this->dbManager = $manager;
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