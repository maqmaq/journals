<?php

namespace Article\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;

class CategoryBase
    extends Model
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\CategorySchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'Article\\Model\\CategorySchema';

    const LABEL = 'Category';

    const MODEL_NAME = 'Category';

    const MODEL_NAMESPACE = 'Article\\Model';

    const MODEL_CLASS = 'Article\\Model\\Category';

    const REPO_CLASS = 'Article\\Model\\CategoryRepoBase';

    const COLLECTION_CLASS = 'Article\\Model\\CategoryCollection';

    const TABLE = 'categories';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'name',
    );

    public static $mixin_classes = array (
    );

    protected $table = 'categories';

    public $id;

    public $name;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\CategorySchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \Article\Model\CategoryRepoBase($write, $read);
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

    public function getName()
    {
        return $this->name;
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "name" => $this->name];
    }

    public function getData()
    {
        return ["id" => $this->id, "name" => $this->name];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("name", $data)) { $this->name = $data["name"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->name = NULL;
    }

    public function fetchArticles()
    {
        return static::masterRepo()->fetchArticlesOf($this);
    }

    public function getArticles()
    {
        $collection = new \Article\Model\ArticleCollection;
        $collection->where()->equal("category_id", $this->id);
        $collection->setPresetVars([ "category_id" => $this->id ]);
        return $collection;
    }
}
