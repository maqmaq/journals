<?php

namespace Core\Router;

/**
 * Interface RouterInterface
 */
interface RouterInterface
{
    /**
     * Load routes config
     * @param array $routes
     * @return mixed
     */
    public function loadRoutes(array $routes);

    /**
     * Try to match given method and uri to loaded routes
     * @param $method
     * @param $uri
     * @param string $prefix
     * @return mixed
     */
    public function parse($method, $uri, $prefix = "");

}