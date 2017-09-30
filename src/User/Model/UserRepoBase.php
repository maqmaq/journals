<?php

namespace User\Model;


use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Model;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use PDO;
use Magsql\Universal\Query\InsertQuery;
use Maghead\Runtime\Repo;

class UserRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'User\\Model\\UserSchema';

    const SCHEMA_PROXY_CLASS = 'User\\Model\\UserSchemaProxy';

    const COLLECTION_CLASS = 'User\\Model\\UserCollection';

    const MODEL_CLASS = 'User\\Model\\User';

    const TABLE = 'users';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM users WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM users WHERE id = ?';

    const FETCH_USER_ARTICLES_SQL = 'SELECT * FROM article_purchasers WHERE user_id = ?';

    public static $columnNames = array (
      0 => 'id',
      1 => 'username',
      2 => 'password',
      3 => 'salt',
      4 => 'wallet',
    );

    public static $columnHash = array (
      'id' => 1,
      'username' => 1,
      'password' => 1,
      'salt' => 1,
      'wallet' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'users';

    protected $loadStm;

    protected $fetchUserArticlesStm;

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
        return $schema = new \User\Model\UserSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'User\Model\User', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new UserCollection($this);
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

    public function fetchUserArticlesOf(Model $record)
    {
        if (!$this->fetchUserArticlesStm) {
            $this->fetchUserArticlesStm = $this->read->prepare(self::FETCH_USER_ARTICLES_SQL);
            $this->fetchUserArticlesStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\ArticlePurchaser::class, [$this]);
        }
        $this->fetchUserArticlesStm->execute([$record->id]);
        return $this->fetchUserArticlesStm->fetchAll();
    }
}
