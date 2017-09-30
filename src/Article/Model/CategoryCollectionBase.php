<?php

namespace Article\Model;


use Maghead\Runtime\Collection;

class CategoryCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\CategorySchemaProxy';

    const MODEL_CLASS = 'Article\\Model\\Category';

    const TABLE = 'categories';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \Article\Model\CategoryRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\CategorySchemaProxy;
    }
}
