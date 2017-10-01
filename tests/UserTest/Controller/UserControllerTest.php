<?php


namespace UserTest\Controller;

use App\Interactor\GetListInterface;
use Core\RenderableInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use User\Controller\UserController;

/**
 * Class UserControllerTest
 * @package UserTest\Controller
 */
class UserControllerTest extends TestCase
{
    public function testListActionGetsInteractorFromContainerAndRunsRendererAndReturnsOutput() {

        $listOfUsers = [];
        $getListInterface = $this->prophesize(GetListInterface::class);
        $getListInterface->execute()->shouldBeCalledTimes(1)->willReturn($listOfUsers);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('user_interactor_get_list')->shouldBeCalledTimes(1)->willReturn($getListInterface->reveal());

        $renderable = $this->prophesize(RenderableInterface::class);
        $expectedRenderContext = [
            'users' => $listOfUsers,
        ];
        $renderable->render(Argument::any(), $expectedRenderContext)->shouldBeCalledTimes(1);

        $authenticationController = new UserController();
        $authenticationController->setContainer($container->reveal());
        $authenticationController->setRenderable($renderable->reveal());

        $authenticationController->listAction();
    }
}