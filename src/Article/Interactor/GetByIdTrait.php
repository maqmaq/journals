<?php


namespace Article\Interactor;

use Maghead\Runtime\Model;
use Maghead\Runtime\Repo;

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
     * @param $idAuthor
     * @return Model|bool
     */
    public function execute($idAuthor)
    {
        return $this->repository->findByPrimaryKey($idAuthor);
    }
}