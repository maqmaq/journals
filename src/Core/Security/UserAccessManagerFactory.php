<?php


namespace Core\Security;

use Core\Authentication\AuthenticatorInterface;

/**
 * Class UserAccessManagerFactory
 * @package Core\Security
 */
class UserAccessManagerFactory
{
    /**
     * @param array $voters
     * @param $attributes
     * @param AuthenticatorInterface $authenticator
     * @return UserAccessManager
     */
    public function create($voters, $attributes, AuthenticatorInterface $authenticator): UserAccessManager
    {
        $decisionManager = new UserVoterDecisionManager($voters, $authenticator->getIdentity(), $attributes);
        return new UserAccessManager($decisionManager);
    }
}