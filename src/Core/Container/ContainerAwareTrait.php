<?php

namespace Core\Container;
/**
 * Class ContainerAwareTrait
 */
trait ContainerAwareTrait
{

    /**
     * @var \Psr\Container\ContainerInterface
     */
    protected $container;

    /**
     * @return \Psr\Container\ContainerInterface
     */
    public function getContainer(): \Psr\Container\ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function setContainer(\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }

}