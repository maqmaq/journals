<?php

namespace Article\Model;


use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Model;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use PDO;
use Magsql\Universal\Query\InsertQuery;
use Maghead\Runtime\Repo;

class CategoryRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'Article\\Model\\CategorySchema';

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\CategorySchemaProxy';

    const COLLECTION_CLASS = 'Article\\Model\\CategoryCollection';

    const MODEL_CLASS = 'Article\\Model\\Category';

    const TABLE = 'categories';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM categories WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM categories WHERE id = ?';

    const FETCH_ARTICLES_SQL = 'SELECT * FROM articles WHERE category_id = ?';

    public static $columnNames = array (
      0 => 'id',
      1 => 'name',
    );

    public static $columnHash = array (
      'id' => 1,
      'name' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'categories';

    protected $loadStm;

    protected $fetchArticlesStm;

    public function free()
    {
        $this->loadStm = null;
        $this->deleteStm = null;
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\CategorySchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'Article\Model\Category', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new CategoryCollection($this);
    }

    protected static function unsetImmutableArgs($args)
    {
        return $args;
    }

    public function deleteByPrimaryKey($pkId)
    {
        if (!$this->deleteStm) {
           $this->deleteStm = $this->write->prepare(self::DELETE_BY_PRIMARY_KEY_SQL);
        }
        return $this->deleteStm->execute([$pkId]);
    }

    public function fetchArticlesOf(Model $record)
    {
        if (!$this->fetchArticlesStm) {
            $this->fetchArticlesStm = $this->read->prepare(self::FETCH_ARTICLES_SQL);
            $this->fetchArticlesStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\Article::class, [$this]);
        }
        $this->fetchArticlesStm->execute([$record->id]);
        return $this->fetchArticlesStm->fetchAll();
    }
}
