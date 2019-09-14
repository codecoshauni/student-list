<?php

namespace Students\Routs;

use Students\{DIContainer, Error404Output};

class Router
{
    use Error404Output;

    private $routes;
    private $container;

    public function __construct(DIContainer $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $this->routes = require_once('routes.php');
        $path = $this->getUrlPath();
        $controllerName = $this->getControllerName($path);

        if (!isset($controllerName)) {
            $this->printError();
        }

        $controller = new $controllerName($this->container);
        $controller->run();
    }

    private function getUrlPath()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return '/' . ltrim(preg_replace('/^\\/index\\.php/', '', $path), '/');
    }

    private function getControllerName(string $path)
    {
        foreach ($this->routes as $route => $controllerName) {
            if ($path === $route) {
                return $controllerName;
            }
        }
    }
}
