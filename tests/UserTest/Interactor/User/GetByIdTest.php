<?php

namespace UserTest\Interactor\User;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use User\Interactor\User\GetById;
use User\Model\UserRepo;

/**
 * Class GetByIdTest
 * @package UserTest\Interactor\User
 */
class GetByIdTest extends TestCase
{
    public function testExecuteReturnsRepositoryFindByPrimaryKeyResult()
    {
        $parameterId = 'someId';
        $expectedValue = 'some-value';

        $repository = $this->prophesize(UserRepo::class);
        $repository->findByPrimaryKey(Argument::exact($parameterId))->shouldBeCalledTimes(1)->willReturn($expectedValue);

        $getById = new GetById($repository->reveal());

        $actualValue = $getById->execute($parameterId);
        $this->assertSame($expectedValue, $actualValue);
    }
}