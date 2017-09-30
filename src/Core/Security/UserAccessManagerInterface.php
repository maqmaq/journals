<?php


namespace Core\Security;


use User\Model\User;

interface UserAccessManagerInterface
{

    /**
     * @param $object
     * @param User|null $user used current if none given
     * @return bool
     */
    public function can($object, User $user = null);
}