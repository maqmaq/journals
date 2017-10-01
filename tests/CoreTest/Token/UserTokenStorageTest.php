<?php

namespace CoreTest\Token;
use Core\Token\UserTokenStorage;
use Maghead\Runtime\Repo;
use Prophecy\Argument;
use User\Model\User;
use User\Model\UserRepo;

/**
 * Class UserTokenStorageTest
 * @package CoreTest\Token
 */
class UserTokenStorageTest extends \PHPUnit\Framework\TestCase
{

    public function testGetUserByTokenReturnsRepositoryFindByPrimaryKeyResult() {

        $token = 'key';
        $expected = new User();
        $repository = $this->prophesize(UserRepo::class);
        $repository->findByPrimaryKey(Argument::exact($token))->shouldBeCalledTimes(1)->willReturn($expected);

        $userTokenStorage = new UserTokenStorage($repository->reveal());
        $actual = $userTokenStorage->getUserByToken($token);
        $this->assertSame($expected, $actual);
    }

    public function testGetAnonymousUserReturnsUser() {

        $repoStub = $this->getMockBuilder(Repo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userTokenStorage = new UserTokenStorage($repoStub);
        $this->assertInstanceOf(User::class, $userTokenStorage->getAnonymousUser());

    }
}