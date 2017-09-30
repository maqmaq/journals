<?php

namespace Article\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class ArticleAuthorSchemaProxy
    extends RuntimeSchema
{

    const SCHEMA_CLASS = 'Article\\Model\\ArticleAuthorSchema';

    const LABEL = 'ArticleAuthor';

    const MODEL_NAME = 'ArticleAuthor';

    const MODEL_NAMESPACE = 'Article\\Model';

    const MODEL_CLASS = 'Article\\Model\\ArticleAuthor';

    const REPO_CLASS = 'Article\\Model\\ArticleAuthorRepoBase';

    const COLLECTION_CLASS = 'Article\\Model\\ArticleAuthorCollection';

    const TABLE = 'article_authors';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_hash = array (
      'id' => 1,
      'author_id' => 1,
      'article_id' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'author_id',
      2 => 'article_id',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'author_id',
      2 => 'article_id',
    );

    public $label = 'ArticleAuthor';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
        $this->relations = array( 
      'article' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'Article\\Model\\ArticleSchema',
          'foreign_column' => 'id',
          'self_schema' => 'Article\\Model\\ArticleAuthorSchema',
          'self_column' => 'article_id',
        ),
      'accessor' => 'article',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => 'CASCADE',
      'onDelete' => 'CASCADE',
      'usingIndex' => NULL,
    )),
      'author' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'Article\\Model\\AuthorSchema',
          'foreign_column' => 'id',
          'self_schema' => 'Article\\Model\\ArticleAuthorSchema',
          'self_column' => 'author_id',
        ),
      'accessor' => 'author',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => 'CASCADE',
      'onDelete' => 'CASCADE',
      'usingIndex' => NULL,
    )),
    );
        $this->columns[ 'id' ] = new RuntimeColumn('id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'autoIncrement' => true,
          'renderAs' => 'HiddenInput',
          'widgetAttributes' => array( 
            ),
        ),
      'name' => 'id',
      'primary' => true,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'autoIncrement' => true,
      'renderAs' => 'HiddenInput',
      'widgetAttributes' => array( 
        ),
    ));
        $this->columns[ 'author_id' ] = new RuntimeColumn('author_id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'required' => true,
          'refer' => 'Article\\Model\\AuthorSchema',
          'length' => NULL,
        ),
      'name' => 'author_id',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'required' => true,
      'refer' => 'Article\\Model\\AuthorSchema',
      'length' => NULL,
    ));
        $this->columns[ 'article_id' ] = new RuntimeColumn('article_id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'required' => true,
          'refer' => 'Article\\Model\\ArticleSchema',
          'length' => NULL,
        ),
      'name' => 'article_id',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'required' => true,
      'refer' => 'Article\\Model\\ArticleSchema',
      'length' => NULL,
    ));
    }
}
