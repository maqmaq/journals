<?php

namespace Core\Security;

use User\Model\User;

/**
 * Interface VoteInterface
 * @package Core\Security
 */
interface UserVoteInterface
{

    /**
     * Runs vote process
     * @param $subject
     * @param User|null $user
     * @return bool
     */
    public function vote($subject, User $user = null): bool;
}