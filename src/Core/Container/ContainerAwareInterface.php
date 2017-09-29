<?php

namespace Core\Container;

/**
 * Interface ContainerAwareInterface
 */
interface ContainerAwareInterface
{

    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return mixed
     */
    public function setContainer(\Psr\Container\ContainerInterface $container);

    /**
     * @return \Psr\Container\ContainerInterface
     */
    public function getContainer();

}