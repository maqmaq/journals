<?php

namespace App\Interactor;

use Maghead\Runtime\Model;
use Maghead\Runtime\Repo;

/**
 * Class GetByIdTrait
 * @package Article\Interactor
 */
trait GetByIdTrait
{
    /**
     * @var Repo
     */
    protected $repository;

    /**
     * GetList constructor.
     * @param Repo $repository
     */
    public function __construct(Repo $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $authorId
     * @return Model|bool
     */
    public function execute($authorId)
    {
        return $this->repository->findByPrimaryKey($authorId);
    }
}