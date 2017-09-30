<?php

namespace Article\Model;


use Maghead\Runtime\Collection;

class ArticleAuthorCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticleAuthorSchemaProxy';

    const MODEL_CLASS = 'Article\\Model\\ArticleAuthor';

    const TABLE = 'article_authors';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \Article\Model\ArticleAuthorRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\ArticleAuthorSchemaProxy;
    }
}
