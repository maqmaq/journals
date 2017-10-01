<?php


namespace AppTest\Twig;

use App\Twig\EnvironmentFactory;
use Core\Router\UriResolverInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Twig_Environment;
use Twig_LoaderInterface;

/**
 * Class EnvironmentFactoryTest
 * @package AppTest\Twig
 */
class EnvironmentFactoryTest extends TestCase
{

    public function testCreateReturnsTwigEnvironmentWithLoadedExtensions()
    {
        $twigEnvironmentConfig = [];
        $container = $this->prophesize(ContainerInterface::class);

        $twigLoaderInterface = $this->prophesize(Twig_LoaderInterface::class);

        $uriResolverInterface = $this->prophesize(UriResolverInterface::class);

        $container->get('twig_loader')->shouldBeCalledTimes(1)->willReturn($twigLoaderInterface->reveal());
        $container->get('twig_environment_config')->shouldBeCalledTimes(1)->willReturn($twigEnvironmentConfig);
        $container->get('core_uri_resolver')->shouldBeCalledTimes(1)->willReturn($uriResolverInterface->reveal());

        $environmentFactory = new EnvironmentFactory($container->reveal());
        $actual = $environmentFactory->create();

        $this->assertInstanceOf(Twig_Environment::class, $actual);
    }


}