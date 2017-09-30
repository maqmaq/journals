<?php

namespace Article\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;

class AuthorBase
    extends Model
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\AuthorSchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'Article\\Model\\AuthorSchema';

    const LABEL = 'Author';

    const MODEL_NAME = 'Author';

    const MODEL_NAMESPACE = 'Article\\Model';

    const MODEL_CLASS = 'Article\\Model\\Author';

    const REPO_CLASS = 'Article\\Model\\AuthorRepoBase';

    const COLLECTION_CLASS = 'Article\\Model\\AuthorCollection';

    const TABLE = 'authors';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'first_name',
      2 => 'last_name',
      3 => 'about',
    );

    public static $mixin_classes = array (
    );

    protected $table = 'authors';

    public $id;

    public $first_name;

    public $last_name;

    public $about;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\AuthorSchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \Article\Model\AuthorRepoBase($write, $read);
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

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "first_name" => $this->first_name, "last_name" => $this->last_name, "about" => $this->about];
    }

    public function getData()
    {
        return ["id" => $this->id, "first_name" => $this->first_name, "last_name" => $this->last_name, "about" => $this->about];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("first_name", $data)) { $this->first_name = $data["first_name"]; }
        if (array_key_exists("last_name", $data)) { $this->last_name = $data["last_name"]; }
        if (array_key_exists("about", $data)) { $this->about = $data["about"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->first_name = NULL;
        $this->last_name = NULL;
        $this->about = NULL;
    }

    public function fetchAuthorArticles()
    {
        return static::masterRepo()->fetchAuthorArticlesOf($this);
    }

    public function getAuthorArticles()
    {
        $collection = new \Article\Model\ArticleAuthorCollection;
        $collection->where()->equal("author_id", $this->id);
        $collection->setPresetVars([ "author_id" => $this->id ]);
        return $collection;
    }

    public function getArticles()
    {
        $collection = new \Article\Model\ArticleCollection;
        $collection->joinTable('article_authors', 'j', 'INNER')
           ->on("j.article_id = {$collection->getAlias()}.id");
        $collection->where()->equal('j.author_id', $this->id);
        $parent = $this;
        $collection->setAfterCreate(function($record, $args) use ($parent) {
           $a = [
              'article_id' => $record->get("id"),
              'author_id' => $parent->id,
           ];
           if (isset($args['author_articles'])) {
              $a = array_merge($args['author_articles'], $a);
           }
           return \Article\Model\ArticleAuthor::createAndLoad($a);
        });
        return $collection;
    }
}
