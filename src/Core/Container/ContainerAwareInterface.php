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
     * @return void
     */
    public function setContainer(ContainerInterface $container): void;

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface;

}