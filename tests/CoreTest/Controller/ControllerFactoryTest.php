<?php

namespace CoreTest\Controller;

use Core\Controller\ControllerFactory;
use Core\RenderableInterface;
use Core\Router\UriResolverInterface;
use DI\Definition\Definition;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use User\Controller\UserController;

/**
 * Class ControllerFactoryTest
 * @package CoreTest\Controller
 */
class ControllerFactoryTest extends TestCase
{

    public function testCreateReturnsInitializedController() {

        $controllerClass = UserController::class ;

        $definition = $this->prophesize(Definition::class);
        $definition->getName()->shouldBeCalledTimes(1)->willReturn($controllerClass);

        $renderableInterface = $this->prophesize(RenderableInterface::class);
        $uriResolverInterface = $this->prophesize(UriResolverInterface::class);

        $containerInterface = $this->prophesize(ContainerInterface::class);
        $containerInterface->get('core_view')->shouldBeCalledTimes(1)->willReturn($renderableInterface);
        $containerInterface->get('core_uri_resolver')->shouldBeCalledTimes(1)->willReturn($uriResolverInterface);

        $factory = new ControllerFactory();
        $factory->create($containerInterface->reveal(), $definition->reveal());
    }
}