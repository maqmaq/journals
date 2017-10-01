<?php


namespace Core\Router;

/**
 *
 * Class UriResolver
 * @package Core\Router
 */
class UriResolver implements UriResolverInterface
{
    /**
     * @var UriResolverInterface
     */
    protected $routerInterface;

    /**
     * UriResolver constructor.
     * @param UriResolverInterface $routerInterface
     */
    public function __construct(UriResolverInterface $routerInterface)
    {
        $this->routerInterface = $routerInterface;
    }

    /**
     * @param string $name
     * @param array $parameters
     * @return null|string
     */
    public function findURI($name, $parameters = [])
    {
        return $this->routerInterface->findURI($name, $parameters);
    }


}