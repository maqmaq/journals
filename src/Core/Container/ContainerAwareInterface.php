<?php

namespace Core\Container;

use Psr\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 */
interface ContainerAwareInterface
{

    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function setContainer(ContainerInterface $container);

    /**
     * @return ContainerInterface
     */
    public function getContainer();

}