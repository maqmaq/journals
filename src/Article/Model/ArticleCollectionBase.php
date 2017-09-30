<?php

namespace Article\Model;


use Maghead\Runtime\Collection;

class ArticleCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticleSchemaProxy';

    const MODEL_CLASS = 'Article\\Model\\Article';

    const TABLE = 'articles';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \Article\Model\ArticleRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\ArticleSchemaProxy;
    }
}
