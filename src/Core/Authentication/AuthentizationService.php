<?php

namespace Core\Authentication;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use User\Model\User;

/**
 * Class AuthenticationService
 * @package Core\Authentication
 */
class AuthentizationService implements AuthenticatorInterface
{
    /**
     * Identity key in storage
     */
    const IDENTITY_KEY = 'identity';
    /**
     * @var SessionInterface
     */
    protected $storage;

    /**
     * @return mixed|null
     */
    public function getIdentity()
    {

        /** @var User $user */

        $repo = User::masterRepo();

        $user = $repo->findByPrimaryKey(1);
        return $user;

        // @todo to be continued
        if ($this->storage->has(self::IDENTITY_KEY)) {
            return $this->storage->get(self::IDENTITY_KEY);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasIdentity()
    {
        return true;

        return $this->storage->has(self::IDENTITY_KEY);

        // TODO: Implement hasIdentity() method.
    }
}