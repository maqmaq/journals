<?php


namespace CoreTest\Security;

use Core\Authentication\AuthenticatorInterface;
use Core\Security\UserAccessManager;
use Core\Security\UserAccessManagerFactory;
use PHPUnit\Framework\TestCase;
use User\Model\User;

/**
 * Class UserAccessManagerFactoryTest
 * @package CoreTest\Security
 */
class UserAccessManagerFactoryTest extends TestCase
{

    public function testCreateReturnsUserAccessManagerObject() {

        $voters = [];
        $attribures = [];
        $user = new User();
        $authenticator = $this->prophesize(AuthenticatorInterface::class);
        $authenticator->getIdentity()->shouldBeCalledTimes(1)->willReturn($user);

        $userAccessManagerFac = new UserAccessManagerFactory();
        $actual = $userAccessManagerFac->create($voters, $attribures, $authenticator->reveal());
        $this->assertInstanceOf(UserAccessManager::class, $actual);
    }
}