<?php


namespace Core;

use Core\Controller\ControllerAbstract;
use Core\Service\ControllerInitializer;
use QuimCalpe\Router\Dispatcher\DispatcherInterface;
use QuimCalpe\Router\Route\ParsedRoute;
use RuntimeException;

/**
 * Class Dispatcher
 * @package Core
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * Default action
     */
    const DEFAULT_ACTION = 'indexAction';
    /**
     * @var ControllerInitializer
     */
    private $controllerInitializer;


    /**
     * Dispatcher constructor.
     * @param ControllerInitializer $controllerInitializer
     */
    public function __construct(ControllerInitializer $controllerInitializer)
    {
        $this->controllerInitializer = $controllerInitializer;
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
     * @return ControllerAbstract
     */
    protected function getControllerInstance($controllerClassName): ControllerAbstract
    {
        return $this->controllerInitializer->initialize($controllerClassName);
    }
}