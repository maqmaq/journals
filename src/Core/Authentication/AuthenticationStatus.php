<?php


namespace Core\Authentication;


/**
 * Class AuthenticationStatus
 * @package Core\Authentication
 */
class AuthenticationStatus
{
    /**
     * Already authenticated
     */
    public const STATUS_ALREADY_AUTHENTICATED = 'already_authenticated';
    /**
     * Successful authenticated
     */
    public const STATUS_AUTHENTICATION_SUCCESSFUL = 'authentication_successful';
    /**
     * Failed to authenticate
     */
    public const STATUS_AUTHENTICATION_FAILED = 'authentication_failed';

}