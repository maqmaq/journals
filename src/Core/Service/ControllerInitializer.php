<?php

namespace Core\Service;

use Core\Container\ContainerAwareInterface;
use Core\Container\ContainerAwareTrait;
use Core\Controller\ControllerAbstract;
use Psr\Container\ContainerInterface;

/**
 * Class ControllerInitializer
 * @package Core\Service
 */
class ControllerInitializer implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * ControllerInitializer constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @param string $controllerClass
     * @return ControllerAbstract
     */
    public function initialize(string $controllerClass)
    {
        return $this->getContainer()->get($controllerClass);
    }
}