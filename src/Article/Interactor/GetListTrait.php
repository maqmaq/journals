<?php

namespace Article\Interactor;

use Maghead\Runtime\Repo;

trait GetListTrait
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
     * @return array
     */
    public function execute()
    {
        return $this->repository->collection()->selectAll();
    }
}