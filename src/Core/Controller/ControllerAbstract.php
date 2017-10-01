<?php

namespace Core\Controller;

use Core\Container\ContainerAwareInterface;
use Core\Container\ContainerAwareTrait;
use Core\Renderable\RenderableAwareInterface;
use Core\Renderable\RenderableAwareTrait;
use Core\UriResolver\UriResolverAwareInterface;
use Core\UriResolver\UriResolverAwareTrait;

/**
 * Class ControllerAbstract
 * @package Core\Controller
 */
abstract class ControllerAbstract implements ContainerAwareInterface, RenderableAwareInterface, UriResolverAwareInterface
{
    use ContainerAwareTrait;
    use RenderableAwareTrait;
    use UriResolverAwareTrait;

    /**
     * @param $name
     * @param array $context
     * @return string
     */
    protected function render($name, array $context = array()): string
    {
        return $this->renderable->render($name, $context);
    }

    /**
     * @param string $routeName
     * @param array $routeParams
     */
    public function redirectToRoute(string $routeName, array $routeParams = []): void
    {
        // because my request cannot into redirects
        $url = $this->getUriResolver()->findURI($routeName, $routeParams);
        $this->setHeaderLocationAndTerminate($url);
    }

    /**
     * Sets header location and terminate script
     * @param string $url
     */
    protected function setHeaderLocationAndTerminate(string $url): void
    {
        header(sprintf('Location: %s', $url));
        exit;
    }


}