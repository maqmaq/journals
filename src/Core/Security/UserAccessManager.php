<?php


namespace Core\Security;

use User\Model\User;

/**
 * Class UserAccessManager
 * @package Core\Security
 */
class UserAccessManager implements UserAccessManagerInterface
{

    /**
     * @var UserVoteInterface
     */
    protected $decisionManager;

    /**
     * UserAccessManager constructor.
     * @param UserVoteInterface $decisionManager
     */
    public function __construct(UserVoteInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * @param $object
     * @param User|null $user
     * @return bool
     */
    public function can($object, User $user = null)
    {
        return $this->decisionManager->vote($object, $user);
    }


}