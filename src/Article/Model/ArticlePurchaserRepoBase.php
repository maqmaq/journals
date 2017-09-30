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

class ArticlePurchaserRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'Article\\Model\\ArticlePurchaserSchema';

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticlePurchaserSchemaProxy';

    const COLLECTION_CLASS = 'Article\\Model\\ArticlePurchaserCollection';

    const MODEL_CLASS = 'Article\\Model\\ArticlePurchaser';

    const TABLE = 'article_purchasers';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM article_purchasers WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM article_purchasers WHERE id = ?';

    const FETCH_ARTICLE_SQL = 'SELECT * FROM articles WHERE id = ? LIMIT 1';

    const FETCH_PURCHASER_SQL = 'SELECT * FROM users WHERE id = ? LIMIT 1';

    const FETCH_USER_SQL = 'SELECT * FROM users WHERE id = ? LIMIT 1';

    public static $columnNames = array (
      0 => 'id',
      1 => 'user_id',
      2 => 'article_id',
    );

    public static $columnHash = array (
      'id' => 1,
      'user_id' => 1,
      'article_id' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'article_purchasers';

    protected $loadStm;

    protected $fetchArticleStm;

    protected $fetchPurchaserStm;

    protected $fetchUserStm;

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
        return $schema = new \Article\Model\ArticlePurchaserSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'Article\Model\ArticlePurchaser', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new ArticlePurchaserCollection($this);
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

    public function fetchArticleOf(Model $record)
    {
        if (!$this->fetchArticleStm) {
            $this->fetchArticleStm = $this->read->prepare(self::FETCH_ARTICLE_SQL);
            $this->fetchArticleStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\Article::class, [$this]);
        }
        $this->fetchArticleStm->execute([$record->article_id]);
        $obj = $this->fetchArticleStm->fetch();
        $this->fetchArticleStm->closeCursor();
        return $obj;
    }

    public function fetchPurchaserOf(Model $record)
    {
        if (!$this->fetchPurchaserStm) {
            $this->fetchPurchaserStm = $this->read->prepare(self::FETCH_PURCHASER_SQL);
            $this->fetchPurchaserStm->setFetchMode(PDO::FETCH_CLASS, \User\Model\User::class, [$this]);
        }
        $this->fetchPurchaserStm->execute([$record->user_id]);
        $obj = $this->fetchPurchaserStm->fetch();
        $this->fetchPurchaserStm->closeCursor();
        return $obj;
    }

    public function fetchUserOf(Model $record)
    {
        if (!$this->fetchUserStm) {
            $this->fetchUserStm = $this->read->prepare(self::FETCH_USER_SQL);
            $this->fetchUserStm->setFetchMode(PDO::FETCH_CLASS, \User\Model\User::class, [$this]);
        }
        $this->fetchUserStm->execute([$record->user_id]);
        $obj = $this->fetchUserStm->fetch();
        $this->fetchUserStm->closeCursor();
        return $obj;
    }
}
