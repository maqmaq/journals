<?php

namespace Core\Security;

use User\Model\User;

/**
 * Class UserVoterDecisionManager
 * @package Core\Security
 */
class UserVoterDecisionManager implements UserVoteInterface
{
    /**
     * @var UserVoterAbstract[]
     */
    protected $voters;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * UserVoterDecisionManager constructor.
     * @param UserVoterAbstract[] $voters
     * @param User $user
     * @param array $attributes
     */
    public function __construct(array $voters, User $user, array $attributes)
    {
        $this->voters = $voters;
        $this->user = $user;
        $this->attributes = $attributes;
    }

    /**
     * @param $subject
     * @param User|null $user
     * @return bool
     */
    public function vote($subject, User $user = null): bool
    {

        if ($user === null) {
            $user = $this->getUser();
        }

        foreach ($this->getVoters() as $voter) {

            if ($voter->voteForSubjectAttributesByUser($user, $subject, $this->getAttributes())) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return UserVoterAbstract[]
     */
    public function getVoters(): array
    {
        return $this->voters;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }


}