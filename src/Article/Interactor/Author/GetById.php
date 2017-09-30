<?php


namespace Article\Interactor\Author;

use Maghead\Runtime\Repo;

/**
 * Class GetById
 * @package Article\Interactors\Article
 */
class GetById
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
     * @return mixed
     */
    public function execute($idAuthor)
    {
        return $this->repository->findByPrimaryKey($idAuthor);
    }
}