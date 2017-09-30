<?php

namespace Core\Controller;

use Core\Container\ContainerAwareInterface;
use Core\Container\ContainerAwareTrait;
use Core\Renderable\RenderableAwareInterface;
use Core\Renderable\RenderableAwareTrait;

/**
 * Class ControllerAbstract
 * @package Core\Controller
 */
abstract class ControllerAbstract implements ContainerAwareInterface, RenderableAwareInterface
{
    use ContainerAwareTrait;
    use RenderableAwareTrait;

    /**
     * @param $name
     * @param array $context
     * @return string
     */
    protected function render($name, array $context = array())
    {
        return $this->renderable->render($name, $context);
    }

    /**
     * @param string $routeName
     * @param array $routeParams
     */
    public function redirectToRoute(string $routeName, array $routeParams = [])
    {
        // becouse my request cannot into redirects

        $url = sprintf('%s', $routeName);

        header(sprintf('Location: %s', $url));
        exit;
    }


}