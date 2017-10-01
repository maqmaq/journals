<?php

namespace App\Interactor;

use Maghead\Runtime\Repo;

/**
 * Class GetListTrait
 * @package App\Interactor
 */
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
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->collection()->selectAll();
    }
}