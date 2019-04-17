<?php

namespace router;

use DIContainer;

class Router
{
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
            header("HTTP/1.0 404 Not Found");
            include_once('../../templates/404page.php');
            die();
        }

        $controller = new $controllerName($this->container->get('studentsDataGateway'));
        $controller->run();
    }

    private function getUrlPath()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return '/' . ltrim(str_replace('index.php', '', $path), '/');
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
