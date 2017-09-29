<?php

namespace Core\Controller;
use Core\Container\ContainerAwareInterface;
use Core\Container\ContainerAwareTrait;

/**
 * Class ControllerAbstract
 * @package Core\Controller
 */
abstract class ControllerAbstract implements ContainerAwareInterface
{

    use ContainerAwareTrait;

}