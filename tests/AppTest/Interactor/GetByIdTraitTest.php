<?php

namespace AppTest\Interactor;

use App\Interactor\GetByIdTrait;
use User\Model\UserRepo;

/**
 * Class GetByIdTraitTest
 * @package AppTest\Interactor
 */
class GetByIdTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testExecuteReturnsRepositoryFindByPrimaryKeyReturnValue() {

        $expected = 'expected';
        $someId = 'someId';
        $repositoryMock = $this->getMockBuilder(UserRepo::class)
            ->disableOriginalConstructor()
            ->setMethods(['findByPrimaryKey'])
            ->getMock();

        $repositoryMock->expects($this->once())->method('findByPrimaryKey')->willReturn($expected);

        $mock = $this->getMockForTrait(GetByIdTrait::class, [$repositoryMock]);

        $actual = $mock->execute($someId);
        $this->assertSame($expected, $actual);

    }
}