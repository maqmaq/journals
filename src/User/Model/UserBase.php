<?php

namespace User\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;

class UserBase
    extends Model
{

    const SCHEMA_PROXY_CLASS = 'User\\Model\\UserSchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'User\\Model\\UserSchema';

    const LABEL = 'User';

    const MODEL_NAME = 'User';

    const MODEL_NAMESPACE = 'User\\Model';

    const MODEL_CLASS = 'User\\Model\\User';

    const REPO_CLASS = 'User\\Model\\UserRepoBase';

    const COLLECTION_CLASS = 'User\\Model\\UserCollection';

    const TABLE = 'users';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'username',
      2 => 'password',
      3 => 'salt',
      4 => 'wallet',
    );

    public static $mixin_classes = array (
    );

    protected $table = 'users';

    public $id;

    public $username;

    public $password;

    public $salt;

    public $wallet;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \User\Model\UserSchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \User\Model\UserRepoBase($write, $read);
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getKey()
    {
        return $this->id;
    }

    public function hasKey()
    {
        return isset($this->id);
    }

    public function setKey($key)
    {
        return $this->id = $key;
    }

    public function removeLocalPrimaryKey()
    {
        $this->id = null;
    }

    public function getId()
    {
        return intval($this->id);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getWallet()
    {
        return Inflator::inflate($this->wallet, 'double');
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "username" => $this->username, "password" => $this->password, "salt" => $this->salt, "wallet" => $this->wallet];
    }

    public function getData()
    {
        return ["id" => $this->id, "username" => $this->username, "password" => $this->password, "salt" => $this->salt, "wallet" => $this->wallet];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("username", $data)) { $this->username = $data["username"]; }
        if (array_key_exists("password", $data)) { $this->password = $data["password"]; }
        if (array_key_exists("salt", $data)) { $this->salt = $data["salt"]; }
        if (array_key_exists("wallet", $data)) { $this->wallet = $data["wallet"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->username = NULL;
        $this->password = NULL;
        $this->salt = NULL;
        $this->wallet = NULL;
    }

    public function fetchUserArticles()
    {
        return static::masterRepo()->fetchUserArticlesOf($this);
    }

    public function getUserArticles()
    {
        $collection = new \Article\Model\ArticlePurchaserCollection;
        $collection->where()->equal("user_id", $this->id);
        $collection->setPresetVars([ "user_id" => $this->id ]);
        return $collection;
    }

    public function getArticles()
    {
        $collection = new \Article\Model\ArticleCollection;
        $collection->joinTable('article_purchasers', 'j', 'INNER')
           ->on("j.article_id = {$collection->getAlias()}.id");
        $collection->where()->equal('j.user_id', $this->id);
        $parent = $this;
        $collection->setAfterCreate(function($record, $args) use ($parent) {
           $a = [
              'article_id' => $record->get("id"),
              'user_id' => $parent->id,
           ];
           if (isset($args['user_articles'])) {
              $a = array_merge($args['user_articles'], $a);
           }
           return \Article\Model\ArticlePurchaser::createAndLoad($a);
        });
        return $collection;
    }
}
