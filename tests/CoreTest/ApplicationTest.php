<?php


namespace CoreTest;

use Core\Application;
use Core\Router\RouterInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use QuimCalpe\Router\Dispatcher\DispatcherInterface;
use QuimCalpe\Router\Route\ParsedRoute;

/**
 * Class ApplicationTest
 * @package CoreTest
 */
class ApplicationTest extends TestCase
{

    public function testInitRunsAllInitMethods()
    {

        $applicationMock = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'initEnvironment',
                'initRouter',
                'initDispatcher',
                'initDatabase',
                'initSession',
            ])
            ->getMock();


        $applicationMock->expects($this->once())->method('initEnvironment');
        $applicationMock->expects($this->once())->method('initRouter');
        $applicationMock->expects($this->once())->method('initDispatcher');
        $applicationMock->expects($this->once())->method('initDatabase');
        $applicationMock->expects($this->once())->method('initSession');

        $applicationMock->init();

    }

    public function testRunCalledRouterAndDispatcher() {

        $config = [];
        $controller = 'constroller';
        $route = new ParsedRoute($controller);

        $containerInterface = $this->prophesize(ContainerInterface::class);
        $routerInterface = $this->prophesize(RouterInterface::class);

        $routerInterface->parse(Argument::any(), Argument::any())->shouldBeCalledTimes(1)->willReturn($route);

        $dispatcherInterface = $this->prophesize(DispatcherInterface::class);
        $dispatcherInterface->handle(Argument::exact($route))->shouldBeCalledTimes(1);

        $application = new Application($config, $containerInterface->reveal());
        $this->mockProperty($application, 'router', $routerInterface->reveal());
        $this->mockProperty($application, 'dispatcher', $dispatcherInterface->reveal());

        $application->run();

    }

    /**
     * @param $object
     * @param string $propertyName
     * @param $value
     */
    protected function mockProperty($object, string $propertyName, $value)
    {
        $reflectionClass = new \ReflectionClass($object);

        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
        $property->setAccessible(false);
    }
}