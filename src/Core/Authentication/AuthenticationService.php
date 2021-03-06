<?php

namespace Core\Authentication;

use Core\Authentication\Manager\AuthenticationManagerInterface;
use Core\Token\UserTokenStorageInterface;
use User\Model\User;

/**
 * Class AuthenticationService
 * @package Core\Authentication
 */
class AuthenticationService implements AuthenticatorInterface
{

    /**
     * @var AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @var UserTokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * Uninitialized flag
     */
    protected const UNINITIALIZED = 'uninitialized';

    /**
     * @var User
     */
    protected $identity = self::UNINITIALIZED;

    /**
     * AuthenticationService constructor.
     * @param AuthenticationManagerInterface $authenticationManager
     * @param UserTokenStorageInterface $tokenStorage
     */
    public function __construct(AuthenticationManagerInterface $authenticationManager, UserTokenStorageInterface $tokenStorage)
    {
        $this->authenticationManager = $authenticationManager;
        $this->tokenStorage = $tokenStorage;
    }

    /*
     * @return mixed|null
     */
    public function getIdentity()
    {
        if ($this->identity === self::UNINITIALIZED) {
            if (!$this->authenticationManager->hasUserToken()) {
                $this->identity = $this->tokenStorage->getAnonymousUser();
                return $this->identity;
            }

            $identity = $this->tokenStorage->getUserByToken($this->authenticationManager->getUserToken());
            $this->identity = $identity;

        }

        return $this->identity;
    }

    /**
     * @return bool
     */
    public function hasIdentity(): bool
    {
        return $this->authenticationManager->hasUserToken();
    }
}