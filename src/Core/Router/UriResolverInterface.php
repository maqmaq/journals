<?php


namespace Core\Router;

interface UriResolverInterface
{
    /**
     * Finds the uri associated with a given name.
     *
     * @param string $name
     *      Name of the route to find.
     * @param array $parameters
     *      (Optional) Parameters to complete the URI.
     *
     * @return string|null
     */
    public function findURI($name, $parameters = []);
}