<?php

namespace CoreTest\Security;

use Core\Security\UserVoterDecisionManager;
use Core\Security\UserVoterInterface;
use Core\Security\UserVotertInterface;
use PHPUnit\Framework\TestCase;
use User\Model\User;

/**
 * Class UserVoterDecisionManagerTest
 * @package CoreTest\Security
 */
class UserVoterDecisionManagerTest extends TestCase
{

    public function testGetVotersReturnsValuePassedIntoContructor()
    {

        $voters = ['voted'];
        $user = new User();
        $attributes = ['attribute'];

        $userVoterDecisionManager = new UserVoterDecisionManager($voters, $user, $attributes);
        $actual = $userVoterDecisionManager->getVoters();
        $this->assertSame($voters, $actual);
    }

    public function testGetUserReturnsValuePassedIntoContructor()
    {

        $voters = ['voted'];
        $user = new User();
        $attributes = ['attribute'];

        $userVoterDecisionManager = new UserVoterDecisionManager($voters, $user, $attributes);
        $actual = $userVoterDecisionManager->getUser();
        $this->assertSame($user, $actual);
    }

    public function testGetAttributesReturnsValuePassedIntoContructor()
    {

        $voters = ['voted'];
        $user = new User();
        $attributes = ['attribute'];

        $userVoterDecisionManager = new UserVoterDecisionManager($voters, $user, $attributes);
        $actual = $userVoterDecisionManager->getAttributes();
        $this->assertSame($attributes, $actual);
    }

    public function testVoteGetsDefaultUserIfNonePrivided()
    {

        $voters = ['voted'];
        $user = new User();
        $attributes = ['attribute'];

        $userVoterDecisionManagerMock = $this->getMockBuilder(UserVoterDecisionManager::class)
            ->setConstructorArgs([$voters, $user, $attributes])
            ->setMethods(['getUser', 'getVoters'])
            ->getMock();

        $userVoterDecisionManagerMock->expects($this->once())->method('getUser');

        $subject = 'subject';
        $userVoterDecisionManagerMock->vote($subject);

    }

    public function testVoteRunsVoteForSubjectAttributesByUserOnEveryPassedVoterAndReturnsFalseIfNoneOfVotersReturnTrue()
    {
        $user = new User();
        $attributes = ['attribute'];

        $subject = 'subject';

        $voter1 = $this->getMockBuilder(UserVoterInterface::class)
            ->setMethods(['voteForSubjectAttributesByUser', 'supports', 'voteOnAttribute'])
            ->getMock();

        $voter1->expects($this->once())->method('voteForSubjectAttributesByUser')
            ->willReturn(false);

        $voter2 = $this->getMockBuilder(UserVoterInterface::class)
            ->setMethods(['voteForSubjectAttributesByUser', 'supports', 'voteOnAttribute'])
            ->getMock();

        $voter2->expects($this->once())->method('voteForSubjectAttributesByUser')
            ->willReturn(false);

        $voters = [
            $voter1,
            $voter2
        ];
        $userVoterDecisionManagerMock = $this->getMockBuilder(UserVoterDecisionManager::class)
            ->setConstructorArgs([$voters, $user, $attributes])
            ->setMethods(null)
            ->getMock();

        $result = $userVoterDecisionManagerMock->vote($subject, $user);
        $this->assertFalse($result);
    }

    public function testVoteRunsVoteForSubjectAttributesByUserOnEveryPassedVoterAndReturnsFalseIfAtLeastOfVotersReturnTrue()
    {
        $user = new User();
        $attributes = ['attribute'];

        $subject = 'subject';
        $voter1 = $this->getMockBuilder(UserVoterInterface::class)
            ->setMethods(['voteForSubjectAttributesByUser', 'supports', 'voteOnAttribute'])
            ->getMock();

        $voter1->expects($this->once())->method('voteForSubjectAttributesByUser')
            ->willReturn(false);

        $voter2 = $this->getMockBuilder(UserVoterInterface::class)
            ->setMethods(['voteForSubjectAttributesByUser', 'supports', 'voteOnAttribute'])
            ->getMock();

        $voter2->expects($this->once())->method('voteForSubjectAttributesByUser')
            ->willReturn(true);

        $voters = [
            $voter1,
            $voter2
        ];
        $userVoterDecisionManagerMock = $this->getMockBuilder(UserVoterDecisionManager::class)
            ->setConstructorArgs([$voters, $user, $attributes])
            ->setMethods(null)
            ->getMock();

        $result = $userVoterDecisionManagerMock->vote($subject, $user);
        $this->assertTrue($result);
    }
}