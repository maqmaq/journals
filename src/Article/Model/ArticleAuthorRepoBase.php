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

class ArticleAuthorRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'Article\\Model\\ArticleAuthorSchema';

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\ArticleAuthorSchemaProxy';

    const COLLECTION_CLASS = 'Article\\Model\\ArticleAuthorCollection';

    const MODEL_CLASS = 'Article\\Model\\ArticleAuthor';

    const TABLE = 'article_authors';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM article_authors WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM article_authors WHERE id = ?';

    const FETCH_ARTICLE_SQL = 'SELECT * FROM articles WHERE id = ? LIMIT 1';

    const FETCH_AUTHOR_SQL = 'SELECT * FROM authors WHERE id = ? LIMIT 1';

    public static $columnNames = array (
      0 => 'id',
      1 => 'author_id',
      2 => 'article_id',
    );

    public static $columnHash = array (
      'id' => 1,
      'author_id' => 1,
      'article_id' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'article_authors';

    protected $loadStm;

    protected $fetchArticleStm;

    protected $fetchAuthorStm;

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
        return $schema = new \Article\Model\ArticleAuthorSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'Article\Model\ArticleAuthor', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new ArticleAuthorCollection($this);
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

    public function fetchAuthorOf(Model $record)
    {
        if (!$this->fetchAuthorStm) {
            $this->fetchAuthorStm = $this->read->prepare(self::FETCH_AUTHOR_SQL);
            $this->fetchAuthorStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\Author::class, [$this]);
        }
        $this->fetchAuthorStm->execute([$record->author_id]);
        $obj = $this->fetchAuthorStm->fetch();
        $this->fetchAuthorStm->closeCursor();
        return $obj;
    }
}
