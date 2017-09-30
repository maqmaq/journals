<?php

namespace Article\Model;


use Maghead\Runtime\Collection;

class ArticlePurchaserCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticlePurchaserSchemaProxy';

    const MODEL_CLASS = 'Article\\Model\\ArticlePurchaser';

    const TABLE = 'article_purchasers';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \Article\Model\ArticlePurchaserRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\ArticlePurchaserSchemaProxy;
    }
}
