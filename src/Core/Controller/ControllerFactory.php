<?php


namespace Core\Controller;

use Core\Container\ContainerAwareInterface;
use Core\Renderable\RenderableAwareInterface;
use Core\Router\UriResolverInterface;
use Core\UriResolver\UriResolverAwareInterface;
use DI\Definition\Definition;
use Psr\Container\ContainerInterface;

/**
 * @todo refactor, use decorators for controllers?
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

        $renderable = $container->get('core_view');
        /** @var UriResolverInterface $uriResolver */
        $uriResolver = $container->get('core_uri_resolver');

        /** @var ControllerAbstract $controllerInstance */
        $controllerInstance = $this->getController($controllerClassName);
        if ($controllerInstance instanceof ContainerAwareInterface) {
            $controllerInstance->setContainer($container);
        }

        if ($controllerInstance instanceof RenderableAwareInterface) {
            $controllerInstance->setRenderable($renderable);
        }

        if ($controllerInstance instanceof UriResolverAwareInterface) {
            $controllerInstance->setUriResolver($uriResolver);
        }

        return $controllerInstance;
    }

    /**
     * @param $controllerClassName
     * @return ControllerAbstract
     */
    protected function getController($controllerClassName)
    {
        return new $controllerClassName();
    }

}