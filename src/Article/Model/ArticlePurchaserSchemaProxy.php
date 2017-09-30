<?php

namespace Article\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class ArticlePurchaserSchemaProxy
    extends RuntimeSchema
{

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

    public static $column_hash = array (
      'id' => 1,
      'user_id' => 1,
      'article_id' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'user_id',
      2 => 'article_id',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'user_id',
      2 => 'article_id',
    );

    public $label = 'ArticlePurchaser';

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
          'self_schema' => 'Article\\Model\\ArticlePurchaserSchema',
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
      'purchaser' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'User\\Model\\UserSchema',
          'foreign_column' => 'id',
          'self_schema' => 'Article\\Model\\ArticlePurchaserSchema',
          'self_column' => 'user_id',
        ),
      'accessor' => 'purchaser',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => 'CASCADE',
      'onDelete' => 'CASCADE',
      'usingIndex' => NULL,
    )),
      'user' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'User\\Model\\UserSchema',
          'foreign_column' => 'id',
          'self_schema' => 'Article\\Model\\ArticlePurchaserSchema',
          'self_column' => 'user_id',
        ),
      'accessor' => 'user',
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
        $this->columns[ 'user_id' ] = new RuntimeColumn('user_id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'required' => true,
          'refer' => 'User\\Model\\UserSchema',
          'length' => NULL,
        ),
      'name' => 'user_id',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'required' => true,
      'refer' => 'User\\Model\\UserSchema',
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
