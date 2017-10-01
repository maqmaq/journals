<?php

namespace CoreTest;

use Core\View;
use Twig_Environment;

/**
 * Class ViewTest
 * @package CoreTest
 */
class ViewTest extends \PHPUnit\Framework\TestCase
{

    public function testRenderMethoReturnsRendererRenderMethod()
    {
        $name = 'name';
        $context = [];
        $expected = 'expected';
        $twigEnvironment = $this->prophesize(Twig_Environment::class);
        $twigEnvironment->render($name, $context)->shouldBeCalledTimes(1)->willReturn($expected);
        $view = new View($twigEnvironment->reveal());

        $actual = $view->render($name, $context);
        $this->assertSame($expected, $actual);
    }

}