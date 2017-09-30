<?php


namespace Article\Interactor\Article;

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
     * @param $idArticle
     * @return mixed
     */
    public function execute($idArticle)
    {
        return $this->repository->findByPrimaryKey($idArticle);
    }
}