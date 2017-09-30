<?php

namespace Article\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;

class ArticlePurchaserBase
    extends Model
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticlePurchaserSchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'Article\\Model\\ArticlePurchaserSchema';

    const LABEL = 'ArticlePurchaser';

    const MODEL_NAME = 'ArticlePurchaser';

    const MODEL_NAMESPACE = 'Article\\Model';

    const MODEL_CLASS = 'Article\\Model\\ArticlePurchaser';

    const REPO_CLASS = 'Article\\Model\\ArticlePurchaserRepoBase';

    const COLLECTION_CLASS = 'Article\\Model\\ArticlePurchaserCollection';

    const TABLE = 'article_purchasers';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'user_id',
      2 => 'article_id',
    );

    public static $mixin_classes = array (
    );

    protected $table = 'article_purchasers';

    public $id;

    public $user_id;

    public $article_id;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\ArticlePurchaserSchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \Article\Model\ArticlePurchaserRepoBase($write, $read);
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

    public function getUserId()
    {
        return intval($this->user_id);
    }

    public function getArticleId()
    {
        return intval($this->article_id);
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "user_id" => $this->user_id, "article_id" => $this->article_id];
    }

    public function getData()
    {
        return ["id" => $this->id, "user_id" => $this->user_id, "article_id" => $this->article_id];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("user_id", $data)) { $this->user_id = $data["user_id"]; }
        if (array_key_exists("article_id", $data)) { $this->article_id = $data["article_id"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->user_id = NULL;
        $this->article_id = NULL;
    }

    public function fetchArticle()
    {
        return static::masterRepo()->fetchArticleOf($this);
    }

    public function fetchPurchaser()
    {
        return static::masterRepo()->fetchPurchaserOf($this);
    }

    public function fetchUser()
    {
        return static::masterRepo()->fetchUserOf($this);
    }
}
