<?php


namespace Core\Controller;

use Core\Container\ContainerAwareInterface;
use DI\Definition\Definition;
use Psr\Container\ContainerInterface;

/**
 * Class ControllerFactory
 * @package Core\Controller
 */
class ControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @param Definition $definition
     * @return ControllerAbstract
     */
    public function create(ContainerInterface $container, Definition $definition)
    {
        $controllerClassName = $definition->getName();
        /** @var ControllerAbstract $controllerInstance */
        $controllerInstance = new $controllerClassName();
        if ($controllerInstance instanceof ContainerAwareInterface) {
            $controllerInstance->setContainer($container);
        }

        return $controllerInstance;
    }

}