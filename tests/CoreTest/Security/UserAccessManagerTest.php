<?php

namespace CoreTest\Security;

use Core\Security\UserAccessManager;
use Core\Security\UserVoteInterface;

/**
 * Class UserAccessManagerTest
 * @package CoreTest\Security
 */
class UserAccessManagerTest extends \PHPUnit\Framework\TestCase
{

    public function testCanReturnsDecisionManagerReturnValue() {

        $object = 'object';
        $user = null;
        $expected = false;

        $userVoteInterface = $this->prophesize(UserVoteInterface::class);
        $userVoteInterface->vote($object, $user)->shouldBeCalledTimes(1)->willReturn($expected);

        $userAccessManager = new UserAccessManager($userVoteInterface->reveal());
        $actual = $userAccessManager->can($object, $user);
        $this->assertSame($expected, $actual);
    }

}