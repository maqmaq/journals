<?php


namespace CoreTest\Service;

use Core\Controller\ControllerAbstract;
use Core\Service\ControllerInitializer;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;

/**
 * Class ControllerInitializerTest
 * @package CoreTest\Service
 */
class ControllerInitializerTest extends \PHPUnit\Framework\TestCase
{

    public function testInitializeReturnsContainerGetMethodResult() {

        $className = 'className';
        $controller = $this->prophesize(ControllerAbstract::class)->reveal();

        $containerInterface = $this->prophesize(ContainerInterface::class);
        $containerInterface->get(Argument::exact($className))->shouldBeCalledTimes(1)->willReturn($controller);

        $controllerInitializer = new ControllerInitializer($containerInterface->reveal());
        $actual = $controllerInitializer->initialize($className);
        $this->assertSame($controller, $actual);

    }
}