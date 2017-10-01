<?php

namespace UserTest\Controller;

use App\Interactor\GetByIdInterface;
use Core\Authentication\AuthenticationStatus;
use Core\Authentication\AuthenticatorInterface;
use Core\Authentication\Manager\AuthenticationManagerInterface;
use Core\Exception\ObjectNotFoundException;
use Core\RenderableInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use User\Controller\AuthenticationController;
use User\Model\User;

/**
 * Class AuthenticationControllerTest
 * @package UserTest\Controller
 */
class AuthenticationControllerTest extends TestCase
{

    public function testLoginActionShouldCallRender()
    {
        $renderable = $this->prophesize(RenderableInterface::class);

        $renderable->render(Argument::any(), Argument::any())->shouldBeCalledTimes(1);

        $authenticationController = new AuthenticationController();
        $authenticationController->setRenderable($renderable->reveal());

        $authenticationController->loginAction();
    }

    public function testSimpleLoginActionShouldCallRenderWithStatusAlreadyAuthenticatedWhenUserIsLoggedIn()
    {
        $authenticationInterface = $this->prophesize(AuthenticatorInterface::class);
        $authenticationInterface->hasIdentity()->shouldBeCalledTimes(1)->willReturn(true);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('core_authentication_service')->shouldBeCalledTimes(1)->willReturn($authenticationInterface->reveal());

        $renderable = $this->prophesize(RenderableInterface::class);
        $expectedRenderContext = [
            'status' => AuthenticationStatus::STATUS_ALREADY_AUTHENTICATED
        ];
        $renderable->render(Argument::any(), $expectedRenderContext)->shouldBeCalled();

        $authenticationController = new AuthenticationController();
        $authenticationController->setContainer($container->reveal());
        $authenticationController->setRenderable($renderable->reveal());

        $id = 'someId';

        $parameters = [
            'id' => $id
        ];

        $authenticationController->simpleLoginAction($parameters);
    }

    public function testSimpleLoginActionShouldThrowsAnExceptionWhenUserIsLNotLoggedInAndRequestedUserNotFound() {

        $id = 'someId';

        $authenticationInterface = $this->prophesize(AuthenticatorInterface::class);
        $authenticationInterface->hasIdentity()->shouldBeCalledTimes(1)->willReturn(false);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('core_authentication_service')->shouldBeCalledTimes(1)->willReturn($authenticationInterface->reveal());

        $getByIdInterface= $this->prophesize(GetByIdInterface::class);
        $getByIdInterface->execute($id)->shouldBeCalledTimes(1)->willReturn(false);

        $container->get('user_interactor_get_by_id')->shouldBeCalledTimes(1)->willReturn($getByIdInterface->reveal());

        $authenticationController = new AuthenticationController();
        $authenticationController->setContainer($container->reveal());

        $this->expectException(ObjectNotFoundException::class);

        $parameters = [
            'id' => $id
        ];

        $authenticationController->simpleLoginAction($parameters);
    }

    public function testSimpleLoginActionShouldCallRenderWithSuccessfulAuthenticationStatusWhenUserIsNotLoggedInAndRequestedUserExists() {

        $id = 'someId';

        $authenticationInterface = $this->prophesize(AuthenticatorInterface::class);
        $authenticationInterface->hasIdentity()->shouldBeCalledTimes(1)->willReturn(false);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('core_authentication_service')->shouldBeCalledTimes(1)->willReturn($authenticationInterface->reveal());

        $user = new User();

        $getByIdInterface= $this->prophesize(GetByIdInterface::class);
        $getByIdInterface->execute($id)->shouldBeCalledTimes(1)->willReturn($user);

        $authenticationManager = $this->prophesize(AuthenticationManagerInterface::class);
        $authenticationManager->logInUser($user)->shouldBeCalledTimes(1)->willReturn(true);

        $container->get('user_interactor_get_by_id')->shouldBeCalledTimes(1)->willReturn($getByIdInterface->reveal());
        $container->get('core_authentication_manager')->shouldBeCalledTimes(1)->willReturn($authenticationManager);

        $renderable = $this->prophesize(RenderableInterface::class);
        $expectedRenderContext = [
            'status' => AuthenticationStatus::STATUS_AUTHENTICATION_SUCCESSFUL,
            'user' => $user
        ];
        $renderable->render(Argument::any(), $expectedRenderContext)->shouldBeCalledTimes(1);

        $authenticationController = new AuthenticationController();
        $authenticationController->setContainer($container->reveal());
        $authenticationController->setRenderable($renderable->reveal());

        $parameters = [
            'id' => $id
        ];

        $authenticationController->simpleLoginAction($parameters);
    }

    public function testSimpleLoginActionShouldCallRenderWithFailedAuthenticationStatusWhenUserIsNotLoggedInAndRequestedUserExists() {

        $id = 'someId';

        $authenticationInterface = $this->prophesize(AuthenticatorInterface::class);
        $authenticationInterface->hasIdentity()->shouldBeCalledTimes(1)->willReturn(false);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('core_authentication_service')->shouldBeCalledTimes(1)->willReturn($authenticationInterface->reveal());

        $user = new User();

        $getByIdInterface= $this->prophesize(GetByIdInterface::class);
        $getByIdInterface->execute($id)->shouldBeCalledTimes(1)->willReturn($user);

        $authenticationManager = $this->prophesize(AuthenticationManagerInterface::class);
        $authenticationManager->logInUser($user)->shouldBeCalledTimes(1)->willReturn(false);

        $container->get('user_interactor_get_by_id')->shouldBeCalledTimes(1)->willReturn($getByIdInterface->reveal());
        $container->get('core_authentication_manager')->shouldBeCalledTimes(1)->willReturn($authenticationManager);

        $renderable = $this->prophesize(RenderableInterface::class);
        $expectedRenderContext = [
            'status' => AuthenticationStatus::STATUS_AUTHENTICATION_FAILED,
            'user' => $user
        ];
        $renderable->render(Argument::any(), $expectedRenderContext)->shouldBeCalledTimes(1);

        $authenticationController = new AuthenticationController();
        $authenticationController->setContainer($container->reveal());
        $authenticationController->setRenderable($renderable->reveal());

        $parameters = [
            'id' => $id
        ];

        $authenticationController->simpleLoginAction($parameters);
    }
}