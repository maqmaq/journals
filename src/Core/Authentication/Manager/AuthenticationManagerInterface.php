<?php


namespace Core\Authentication\Manager;

use User\Model\User;

/**
 * Interface AuthenticationManagerInterface
 * @package Core\Authentication\Manager
 */
interface AuthenticationManagerInterface
{

    /** Login user
     * @param User $user
     */
    public function logInUser(User $user): bool;

    /**
     * Logout user
     */
    public function logOutUser();

    /**
     * @return bool
     */
    public function hasUserToken(): bool;

    /**
     * @return mixed
     */
    public function getUserToken();
}