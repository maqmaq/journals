<?php

namespace CoreTest\Authentication\Manager;

use Core\Authentication\Manager\AuthenticationManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use User\Model\User;

/**
 * Class AuthenticationManagerTest
 * @package CoreTest\Authentication\Manager
 */
class AuthenticationManagerTest extends TestCase
{

    public function testLoginUserSetUserDataInStorageAndReturnsTrue() {

        $user = new User();

        $sessionInterface = $this->prophesize(SessionInterface::class);
        $sessionInterface->clear()->shouldBeCalledTimes(1);
        $sessionInterface->set(Argument::type('string'), $user->getId())->shouldBeCalledTimes(1);

        $authenticationManager = new AuthenticationManager($sessionInterface->reveal());

        $actual = $authenticationManager->logInUser($user);
        $this->assertTrue($actual);
    }

    public function testLogOutUserClearsDataInStorage() {

        $sessionInterface = $this->prophesize(SessionInterface::class);
        $sessionInterface->remove(Argument::type('string'))->shouldBeCalledTimes(1)->willReturn(true);
        $sessionInterface->clear()->shouldBeCalledTimes(1)->willReturn(true);

        $authenticationManager = new AuthenticationManager($sessionInterface->reveal());

        $actual = $authenticationManager->logOutUser();
        $this->assertTrue($actual);
    }

    public function testHasUserTokenReturnsTrueIfStorageStoresData() {

        $sessionInterface = $this->prophesize(SessionInterface::class);
        $sessionInterface->has(Argument::type('string'))->shouldBeCalledTimes(1)->willReturn(true);

        $authenticationManager = new AuthenticationManager($sessionInterface->reveal());

        $actual = $authenticationManager->hasUserToken();
        $this->assertTrue($actual);
    }

    public function testHasUserTokenReturnsDataFromStorage() {

        $expected = 'data';
        $sessionInterface = $this->prophesize(SessionInterface::class);
        $sessionInterface->get(Argument::type('string'))->shouldBeCalledTimes(1)->willReturn($expected);

        $authenticationManager = new AuthenticationManager($sessionInterface->reveal());

        $actual = $authenticationManager->getUserToken();
        $this->assertSame($expected, $actual);
    }
}