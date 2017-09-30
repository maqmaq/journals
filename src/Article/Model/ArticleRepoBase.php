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

class ArticleRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'Article\\Model\\ArticleSchema';

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticleSchemaProxy';

    const COLLECTION_CLASS = 'Article\\Model\\ArticleCollection';

    const MODEL_CLASS = 'Article\\Model\\Article';

    const TABLE = 'articles';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM articles WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM articles WHERE id = ?';

    public static $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'shortDescription',
      3 => 'content',
      4 => 'price',
    );

    public static $columnHash = array (
      'id' => 1,
      'title' => 1,
      'shortDescription' => 1,
      'content' => 1,
      'price' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'articles';

    protected $loadStm;

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
        return $schema = new \Article\Model\ArticleSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'Article\Model\Article', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new ArticleCollection($this);
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
}
