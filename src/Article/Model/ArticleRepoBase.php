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

    const FETCH_ARTICLE_AUTHORS_SQL = 'SELECT * FROM article_authors WHERE article_id = ?';

    const FETCH_CATEGORY_SQL = 'SELECT * FROM categories WHERE id = ? LIMIT 1';

    public static $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'short_description',
      3 => 'content',
      4 => 'price',
      5 => 'category_id',
    );

    public static $columnHash = array (
      'id' => 1,
      'title' => 1,
      'short_description' => 1,
      'content' => 1,
      'price' => 1,
      'category_id' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'articles';

    protected $loadStm;

    protected $fetchArticleAuthorsStm;

    protected $fetchCategoryStm;

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

    public function fetchArticleAuthorsOf(Model $record)
    {
        if (!$this->fetchArticleAuthorsStm) {
            $this->fetchArticleAuthorsStm = $this->read->prepare(self::FETCH_ARTICLE_AUTHORS_SQL);
            $this->fetchArticleAuthorsStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\ArticleAuthor::class, [$this]);
        }
        $this->fetchArticleAuthorsStm->execute([$record->id]);
        return $this->fetchArticleAuthorsStm->fetchAll();
    }

    public function fetchCategoryOf(Model $record)
    {
        if (!$this->fetchCategoryStm) {
            $this->fetchCategoryStm = $this->read->prepare(self::FETCH_CATEGORY_SQL);
            $this->fetchCategoryStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\Category::class, [$this]);
        }
        $this->fetchCategoryStm->execute([$record->category_id]);
        $obj = $this->fetchCategoryStm->fetch();
        $this->fetchCategoryStm->closeCursor();
        return $obj;
    }
}
