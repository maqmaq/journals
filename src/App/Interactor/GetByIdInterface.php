<?php


namespace App\Interactor;

use Maghead\Runtime\Model;

/**
 * Interface GetByIdInterface
 * @package App\Interactor
 */
interface GetByIdInterface
{
    /**
     * @param $subjectId
     * @return Model|bool
     */
    public function execute($subjectId);

}