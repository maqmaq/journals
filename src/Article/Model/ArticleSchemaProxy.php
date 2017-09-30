<?php

namespace Article\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class ArticleSchemaProxy
    extends RuntimeSchema
{

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

    public static $column_hash = array (
      'id' => 1,
      'title' => 1,
      'short_description' => 1,
      'content' => 1,
      'price' => 1,
      'category_id' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'short_description',
      3 => 'content',
      4 => 'price',
      5 => 'category_id',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'title',
      2 => 'short_description',
      3 => 'content',
      4 => 'price',
      5 => 'category_id',
    );

    public $label = 'Article';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
        $this->relations = array( 
      'article_authors' => \Maghead\Schema\Relationship\HasMany::__set_state(array( 
      'data' => array( 
          'self_schema' => 'Article\\Model\\ArticleSchema',
          'self_column' => 'id',
          'foreign_schema' => 'Article\\Model\\ArticleAuthorSchema',
          'foreign_column' => 'article_id',
        ),
      'accessor' => 'article_authors',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'authors' => \Maghead\Schema\Relationship\ManyToMany::__set_state(array( 
      'data' => array( 
          'relation_junction' => 'article_authors',
          'relation_foreign' => 'author',
          'filter' => function ($collection) {
                    return $collection;
                },
        ),
      'accessor' => 'authors',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'category' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'Article\\Model\\CategorySchema',
          'foreign_column' => 'id',
          'self_schema' => 'Article\\Model\\ArticleSchema',
          'self_column' => 'category_id',
        ),
      'accessor' => 'category',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'article_purchasers' => \Maghead\Schema\Relationship\HasMany::__set_state(array( 
      'data' => array( 
          'self_schema' => 'Article\\Model\\ArticleSchema',
          'self_column' => 'id',
          'foreign_schema' => 'Article\\Model\\ArticlePurchaserSchema',
          'foreign_column' => 'article_id',
        ),
      'accessor' => 'article_purchasers',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'purchasers' => \Maghead\Schema\Relationship\ManyToMany::__set_state(array( 
      'data' => array( 
          'relation_junction' => 'article_purchasers',
          'relation_foreign' => 'purchaser',
          'filter' => function ($collection) {
                    return $collection;
                },
        ),
      'accessor' => 'purchasers',
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
        $this->columns[ 'title' ] = new RuntimeColumn('title',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 128,
          'required' => true,
          'label' => 'Title',
        ),
      'name' => 'title',
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
      'label' => 'Title',
    ));
        $this->columns[ 'short_description' ] = new RuntimeColumn('short_description',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 255,
          'required' => true,
          'label' => 'Short description',
        ),
      'name' => 'short_description',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 255,
      'required' => true,
      'label' => 'Short description',
    ));
        $this->columns[ 'content' ] = new RuntimeColumn('content',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 1024,
          'label' => 'Content',
        ),
      'name' => 'content',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 1024,
      'label' => 'Content',
    ));
        $this->columns[ 'price' ] = new RuntimeColumn('price',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 10,
          'decimals' => 2,
          'default' => 0,
          'label' => 'Price',
        ),
      'name' => 'price',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'double',
      'isa' => 'double',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 10,
      'decimals' => 2,
      'default' => 0,
      'label' => 'Price',
    ));
        $this->columns[ 'category_id' ] = new RuntimeColumn('category_id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'default' => NULL,
        ),
      'name' => 'category_id',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'default' => NULL,
    ));
    }
}
