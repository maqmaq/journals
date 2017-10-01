<?php

namespace App\Seed;
use Maghead\Runtime\BaseSeed as MagHeadBaseSeed;

/**
 * Class BaseSeed
 * @package App\Seed
 */
class BaseSeed extends MagHeadBaseSeed
{

    /**
     * @param $result
     * @return mixed
     * @throws \Exception
     */
    public static function createOrThrowRuntimeException($result)
    {
        if ($result->error) {
            throw new \RuntimeException('Cant save');
        }

        return $result;
    }
}