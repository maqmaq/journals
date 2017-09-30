<?php


namespace Core\Authentication;


/**
 * Interface AuthenticatorInterface
 * @package Core\Authentication
 */
interface AuthenticatorInterface
{
    /**
     * @return mixed|null
     */
    public function getIdentity();

    /**
     * @return bool
     */
    public function hasIdentity();

}