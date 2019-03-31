<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;

class Router
{

    protected $routes = [];

    protected $history = [];

    protected $itemKey = '';

    public function __construct($itemKey)
    {
        $this->itemKey = $itemKey;
    }

    protected function registerRoute($route): void
    {
        if (count($this->history) > 20) {
            $this->history = array_splice(array_reverse($this->history), 0, 20);
        }

        $this->history[] = $route;
    }

    public function setRoute($route, $template)
    {
        $this->registerRoute($route);

        $routesCount = count($route);
        switch ($routesCount) {
            case 0:
                $routeController = 'list';
                break;
            case 1:
                $routeController = ($route[0] === $this->itemKey) ? 'display' : 'page';
                break;
            case ($routesCount > 1):
                $routeController = ($route[0] === $this->itemKey) ? 'display' : $route[0];
                break;
        }

        $controllerDirectory = DIRECTORY_SEPARATOR.'Infrastructure'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR;
        $controllerNamespace = 'Xandrucea\\ItemListDisplay\\Infrastructure\\Controllers\\';
        $controllerFile      = dirname(__DIR__).$controllerDirectory.ucfirst($routeController).'Controller.php';
        $controllerClass     = $controllerNamespace.ucfirst($routeController).'Controller';

        if (file_exists($controllerFile)) {
            $controller = new $controllerClass();

            if ($routesCount > 1) {
                if ($route[0] === $this->itemKey) {
                    $controller->run(array_splice($route, 1));
                } else {
                    echo 'more';
                    $method = $route[1];
                    if (method_exists($controller, $method)) {
                        $controller->$method(array_splice($route, 2));
                    }
                }

            } else {
                if ($route === $this->itemKey) {
                    $controller->run(array_splice($route, 1));
                } else {
                    $controller->run();
                }
            }
        } else {
            echo 'Bad route';
        }
        print_r($controller);
    }

    public function configureRouter($config)
    {
        foreach ($config as $route => $template) {
            $this->routes[$route] = $template;
        }
    }

    public function getHistory()
    {
        return $this->history;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}