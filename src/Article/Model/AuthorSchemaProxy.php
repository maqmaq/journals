<?php

namespace Article\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class AuthorSchemaProxy
    extends RuntimeSchema
{

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

    public static $column_hash = array (
      'id' => 1,
      'first_name' => 1,
      'last_name' => 1,
      'about' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'first_name',
      2 => 'last_name',
      3 => 'about',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'first_name',
      2 => 'last_name',
      3 => 'about',
    );

    public $label = 'Author';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
        $this->relations = array( 
      'author_articles' => \Maghead\Schema\Relationship\HasMany::__set_state(array( 
      'data' => array( 
          'self_schema' => 'Article\\Model\\AuthorSchema',
          'self_column' => 'id',
          'foreign_schema' => 'Article\\Model\\ArticleAuthorSchema',
          'foreign_column' => 'author_id',
        ),
      'accessor' => 'author_articles',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'articles' => \Maghead\Schema\Relationship\ManyToMany::__set_state(array( 
      'data' => array( 
          'relation_junction' => 'author_articles',
          'relation_foreign' => 'article',
        ),
      'accessor' => 'articles',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
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
        $this->columns[ 'first_name' ] = new RuntimeColumn('first_name',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 128,
          'required' => true,
          'label' => 'First Name',
        ),
      'name' => 'first_name',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 128,
      'required' => true,
      'label' => 'First Name',
    ));
        $this->columns[ 'last_name' ] = new RuntimeColumn('last_name',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 128,
          'required' => true,
          'label' => 'Last Name',
        ),
      'name' => 'last_name',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 128,
      'required' => true,
      'label' => 'Last Name',
    ));
        $this->columns[ 'about' ] = new RuntimeColumn('about',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 1024,
          'label' => 'about',
        ),
      'name' => 'about',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 1024,
      'label' => 'about',
    ));
    }
}
