<?php


namespace Core;

use Core\Router\RouterInterface;

/**
 * Class Router
 * @package Core
 */
class Router extends \QuimCalpe\Router\Router implements RouterInterface
{
    /**
     * Position of attribute name in route config
     */
    const ROUTE_NAME_POSITION = 3;

    /**
     * @param array $routes
     * @return void
     */
    public function loadRoutes(array $routes): void
    {
        foreach ($routes as $route) {

            list($method, $uri, $handler) = $route;
            // if name is passed
            $name = (count($route) == (self::ROUTE_NAME_POSITION + 1)) ? $route[self::ROUTE_NAME_POSITION] : null;

            $this->addRoute($method, $uri, $handler, $name);
        }
    }
}