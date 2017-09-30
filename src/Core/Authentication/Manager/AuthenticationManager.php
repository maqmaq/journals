<?php

namespace Core\Authentication\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use User\Model\User;

/**
 * Class AuthenticationManager
 * @package Core\Authentication
 */
class AuthenticationManager implements AuthenticationManagerInterface
{
    /**
     * Key for user data in storage
     */
    protected const KEY_USER = 'user';

    /**
     * @return string
     */
    protected function getKeyUser()
    {
        return self::KEY_USER;
    }

    /**
     * @var SessionInterface
     */
    protected $storage;

    /**
     * AuthenticationManager constructor.
     * @param SessionInterface $storage
     */
    public function __construct(SessionInterface $storage)
    {
        $this->storage = $storage;
    }

    /** Login user
     * @param User $user
     */
    /**
     * @param User $user
     * @return boolean
     */
    public function logInUser(User $user)
    {
        $this->storage->clear();
        $this->storage->set($this->getKeyUser(), $user->getId());
        return true;
    }

    /**
     * Logout user
     * @return mixed
     */
    public function logOutUser()
    {
        return $this->storage->remove($this->getKeyUser()) && $this->storage->clear();
    }

    /**
     * @return bool
     */
    public function hasUserToken()
    {
        return $this->storage->has($this->getKeyUser());
    }

    /**
     * @return mixed
     */
    public function getUserToken()
    {
        return $this->storage->get($this->getKeyUser());
    }
}