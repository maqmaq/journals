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
      'shortDescription' => 1,
      'content' => 1,
      'price' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'shortDescription',
      3 => 'content',
      4 => 'price',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'title',
      2 => 'shortDescription',
      3 => 'content',
      4 => 'price',
    );

    public $label = 'Article';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
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
          'label' => 'title',
        ),
      'name' => 'title',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 128,
      'label' => 'title',
    ));
        $this->columns[ 'shortDescription' ] = new RuntimeColumn('shortDescription',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 255,
          'label' => 'Short description',
        ),
      'name' => 'shortDescription',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 255,
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
          'label' => 'Price',
        ),
      'name' => 'price',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'decimal',
      'isa' => 'int',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 10,
      'decimals' => 2,
      'label' => 'Price',
    ));
    }
}
