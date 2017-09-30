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

class AuthorRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'Article\\Model\\AuthorSchema';

    const SCHEMA_PROXY_CLASS = 'Article\\Model\\AuthorSchemaProxy';

    const COLLECTION_CLASS = 'Article\\Model\\AuthorCollection';

    const MODEL_CLASS = 'Article\\Model\\Author';

    const TABLE = 'authors';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM authors WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM authors WHERE id = ?';

    const FETCH_AUTHOR_ARTICLES_SQL = 'SELECT * FROM article_authors WHERE author_id = ?';

    public static $columnNames = array (
      0 => 'id',
      1 => 'firstName',
      2 => 'lastName',
      3 => 'about',
    );

    public static $columnHash = array (
      'id' => 1,
      'firstName' => 1,
      'lastName' => 1,
      'about' => 1,
    );

    public static $mixinClasses = array (
    );

    protected $table = 'authors';

    protected $loadStm;

    protected $fetchAuthorArticlesStm;

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
        return $schema = new \Article\Model\AuthorSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'Article\Model\Author', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new AuthorCollection($this);
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

    public function fetchAuthorArticlesOf(Model $record)
    {
        if (!$this->fetchAuthorArticlesStm) {
            $this->fetchAuthorArticlesStm = $this->read->prepare(self::FETCH_AUTHOR_ARTICLES_SQL);
            $this->fetchAuthorArticlesStm->setFetchMode(PDO::FETCH_CLASS, \Article\Model\ArticleAuthor::class, [$this]);
        }
        $this->fetchAuthorArticlesStm->execute([$record->id]);
        return $this->fetchAuthorArticlesStm->fetchAll();
    }
}
