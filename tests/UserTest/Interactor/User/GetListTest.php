<?php


namespace UserTest\Interactor\User;

use PHPUnit\Framework\TestCase;
use User\Interactor\User\GetList;
use User\Model\UserCollection;
use User\Model\UserRepo;

/**
 * Class GetListTest
 * @package UserTest\Interactor\User
 */
class GetListTest extends TestCase
{

    public function testExecuteReturnsRepositoryCollectionSelectAll(){

        $expectedValue = [];

        $repositoryUser = $this->prophesize(UserRepo::class);

        $collectionUser = $this->prophesize(UserCollection::class);
        $collectionUser->selectAll()->shouldBeCalledTimes(1)->willReturn($expectedValue);

        $repositoryUser->collection()->shouldBeCalledTimes(1)->willReturn($collectionUser->reveal());

        $getList = new GetList($repositoryUser->reveal());

        $actualValue = $getList->execute();
        $this->assertSame($expectedValue, $actualValue);
    }

}