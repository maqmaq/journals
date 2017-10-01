<?php

namespace App\Twig;

use App\Twig\Extension\RouterExtension;
use Psr\Container\ContainerInterface;
use Twig_Environment;

/**
 * Class EnvironmentFactory
 * @package App\Twig
 */
class EnvironmentFactory
{

    /**
     * @var ContainerInterface
     */
    protected $containerInterface;

    /**
     * EnvironmentFactory constructor.
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->containerInterface = $containerInterface;
    }

    /**
     * @return Twig_Environment
     */
    public function create(): Twig_Environment
    {
        $twigEnvironment = new Twig_Environment($this->containerInterface->get('twig_loader'), $this->containerInterface->get('twig_environment_config'));
        $routerExtensions = new RouterExtension($this->containerInterface->get('core_uri_resolver'));
        $twigEnvironment->addExtension($routerExtensions);
        return $twigEnvironment;
    }
}