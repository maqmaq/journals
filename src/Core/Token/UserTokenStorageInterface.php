<?php


namespace Core\Token;


use User\Model\User;

/**
 * Interface UserTokenStorageInterface
 * @package Core\Token
 */
interface UserTokenStorageInterface
{

    /**
     * @param $token
     * @return User|null
     */
    public function getUserByToken($token);

    /**
     * @return User
     */
    public function getAnonymousUser();

}