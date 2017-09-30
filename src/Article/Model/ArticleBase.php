<?php

namespace Article\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;

class ArticleBase
    extends Model
{

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticleSchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'Article\\Model\\ArticleSchema';

    const LABEL = 'Article';

    const MODEL_NAME = 'Article';

    const MODEL_NAMESPACE = 'Article\\Model';

    const MODEL_CLASS = 'Article\\Model\\Article';

    const REPO_CLASS = 'Article\\Model\\ArticleRepoBase';

    const COLLECTION_CLASS = 'Article\\Model\\ArticleCollection';

    const TABLE = 'articles';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'title',
      2 => 'shortDescription',
      3 => 'content',
      4 => 'price',
    );

    public static $mixin_classes = array (
    );

    protected $table = 'articles';

    public $id;

    public $title;

    public $shortDescription;

    public $content;

    public $price;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \Article\Model\ArticleSchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \Article\Model\ArticleRepoBase($write, $read);
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPrice()
    {
        return intval($this->price);
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "title" => $this->title, "shortDescription" => $this->shortDescription, "content" => $this->content, "price" => $this->price];
    }

    public function getData()
    {
        return ["id" => $this->id, "title" => $this->title, "shortDescription" => $this->shortDescription, "content" => $this->content, "price" => $this->price];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("title", $data)) { $this->title = $data["title"]; }
        if (array_key_exists("shortDescription", $data)) { $this->shortDescription = $data["shortDescription"]; }
        if (array_key_exists("content", $data)) { $this->content = $data["content"]; }
        if (array_key_exists("price", $data)) { $this->price = $data["price"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->title = NULL;
        $this->shortDescription = NULL;
        $this->content = NULL;
        $this->price = NULL;
    }

    public function fetchArticleAuthors()
    {
        return static::masterRepo()->fetchArticleAuthorsOf($this);
    }

    public function getArticleAuthors()
    {
        $collection = new \Article\Model\ArticleAuthorCollection;
        $collection->where()->equal("article_id", $this->id);
        $collection->setPresetVars([ "article_id" => $this->id ]);
        return $collection;
    }

    public function getAuthors()
    {
        $collection = new \Article\Model\AuthorCollection;
        $collection->joinTable('article_authors', 'j', 'INNER')
           ->on("j.author_id = {$collection->getAlias()}.id");
        $collection->where()->equal('j.article_id', $this->id);
        $parent = $this;
        $collection->setAfterCreate(function($record, $args) use ($parent) {
           $a = [
              'author_id' => $record->get("id"),
              'article_id' => $parent->id,
           ];
           if (isset($args['article_authors'])) {
              $a = array_merge($args['article_authors'], $a);
           }
           return \Article\Model\ArticleAuthor::createAndLoad($a);
        });
        return $collection;
    }
}
