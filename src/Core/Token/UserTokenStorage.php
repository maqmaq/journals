<?php

namespace Core\Token;

use Maghead\Runtime\Repo;
use User\Model\User;
use User\Model\UserSchemaProxy;

/**
 * Class UserTokenStorage
 * @package Core\Token
 */
class UserTokenStorage implements UserTokenStorageInterface
{

    /**
     * @var Repo
     */
    protected $repository;

    /**
     * UserTokenStorage constructor.
     * @param Repo $repository
     */
    public function __construct(Repo $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param $token
     * @return User|null
     */
    public function getUserByToken($token)
    {
        return $this->repository->findByPrimaryKey($token);
    }

    /**
     * @return User
     */
    public function getAnonymousUser() {

        // sorry for that, i got no time left
        $className = UserSchemaProxy::MODEL_CLASS;
        return new $className();

    }


}