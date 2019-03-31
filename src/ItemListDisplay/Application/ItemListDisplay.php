<?php

namespace Xandrucea\ItemListDisplay\Application;

use Xandrucea\ItemListDisplay\Infrastructure\Configuration;
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
//        $routes = substr(rtrim($_SERVER['REQUEST_URI'], '/\\'));
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($routes as $route) {
            if (empty($route)) {
                $index = array_search($route, $routes);
                unset($routes[$index]);
            }
        }
        $routes = array_merge($routes);

        self::$router->setRoute($routes, self::$templates);
        /*
        $entryId          = $_GET[self::$config::getItemKey()] ?? false;
        $contentDirectory = self::$config::getContentDirectory();
        $fileFormat       = self::$config::getFileFormat();
        $sortOrder        = self::$config::getSortOrder();
        $itemKey          = self::$config::getItemKey();

        if (empty($entryId)) {
            $storage = array_values(preg_grep('/^([^.])/', scandir($contentDirectory, $sortOrder)));

            $index = 0;
            echo '<ul>';
            foreach ($storage as $filename) {
                ++$index;

                $link = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
//                echo '<a href="?'.$itemKey.'='.$link.'">'.$link.'</a>';
                echo self::$templates::item([
                    '$itemKey' => $itemKey,
                    '$link'    => $link
                ]);

                if ($index < count($storage)) {
                    echo '<br>';
                }
            }
            echo '</ul>';
        } else {
            $entryFile = $contentDirectory.$entryId.'.'.$fileFormat;

            if (file_exists($entryFile)) {
                require $entryFile;

            } else {
                require self::$templates::errorPage();
            }
        }
        */
    }

    public function configureRouter(array $config): void
    {
        self::$router->configureRouter($config);
    }
}