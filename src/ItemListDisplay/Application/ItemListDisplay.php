<?php

namespace Xandrucea\ItemListDisplay\Application;

use Xandrucea\ItemListDisplay\Infrastructure\Configuration\Configuration;
use Xandrucea\ItemListDisplay\Infrastructure\Router;
use Xandrucea\ItemListDisplay\Infrastructure\Template;

class ItemListDisplay
{
    protected static $config;

    protected static $router;

    protected static $templates;

    public function __construct(array $config = [])
    {
        self::$config    = new Configuration($config);
        self::$router    = new Router(self::$config->getItemKey());
        self::$templates = new Template(self::$config->getTemplateDirectory());
    }

    public function render()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($routes as $route) {
            if (empty($route)) {
                $index = array_search($route, $routes);
                unset($routes[$index]);
            }
        }
        $routes = array_merge($routes);

        self::$router->setRoute($routes, self::$templates);
    }

    public function configureRouter(array $config): void
    {
        self::$router->configureRouter($config);
    }
}