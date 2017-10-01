<?php


use Core\RenderableInterface;
use Prophecy\Argument;

/**
 * Class HomepageControllerTest
 */
class HomepageControllerTest extends \PHPUnit\Framework\TestCase
{

    public function testIndexActionCallsRenderAndReturnsOutput()
    {
        $expected = 'expected';

        $renderable = $this->prophesize(RenderableInterface::class);
        $renderable->render(Argument::any(), Argument::any())->shouldBeCalledTimes(1)->willReturn($expected);

        $homepageController = new \App\Controller\HomepageController();
        $homepageController->setRenderable($renderable->reveal());

        $actual = $homepageController->indexAction();
        $this->assertSame($expected, $actual);
        }
}
