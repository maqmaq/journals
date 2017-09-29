<?php


namespace Core;

use Psr\Container\ContainerInterface;
use QuimCalpe\Router\Dispatcher\DispatcherInterface;
use QuimCalpe\Router\Route\ParsedRoute;
use RuntimeException;

/**
 * Class Dispatcher
 * @package Core
 */
class Dispatcher implements DispatcherInterface
{
    const DEFAULT_ACTION = 'indexAction';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Dispatcher constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * Handle given route by running controller
     * @param ParsedRoute $route
     * @return string
     *
     * @throws RuntimeException
     */
    public function handle(ParsedRoute $route)
    {
        $segments = explode("::", $route->controller());
        $controllerName = $segments[0];
        $action = count($segments) > 1 ? $segments[1] : "indexAction";

        $controllerInstance = $this->getControllerInstance($controllerName);
        if (method_exists($controllerInstance, $action)) {
            $params = [$route->params()];
            return call_user_func_array([$controllerInstance, $action], $params);
        } else {
            throw new RuntimeException("No method {$action} in controller {$segments[0]}");
        }
    }

    /**
     * @param $controllerClassName
     * @return mixed
     */
    protected function getControllerInstance($controllerClassName)
    {
        return $this->container->get($controllerClassName);
    }
}