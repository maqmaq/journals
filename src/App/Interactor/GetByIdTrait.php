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
     * @param $subjectId
     * @return Model|bool
     */
    public function execute($subjectId)
    {
        return $this->repository->findByPrimaryKey($subjectId);
    }
}