<?php

namespace Article\Model;


use Maghead\Runtime\Collection;

class AuthorCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\AuthorSchemaProxy';

    const MODEL_CLASS = 'Article\\Model\\Author';

    const TABLE = 'authors';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \Article\Model\AuthorRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\AuthorSchemaProxy;
    }
}
