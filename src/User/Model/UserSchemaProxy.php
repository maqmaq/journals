<?php

namespace User\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class UserSchemaProxy
    extends RuntimeSchema
{

    const SCHEMA_CLASS = 'User\\Model\\UserSchema';

    const LABEL = 'User';

    const MODEL_NAME = 'User';

    const MODEL_NAMESPACE = 'User\\Model';

    const MODEL_CLASS = 'User\\Model\\User';

    const REPO_CLASS = 'User\\Model\\UserRepoBase';

    const COLLECTION_CLASS = 'User\\Model\\UserCollection';

    const TABLE = 'users';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_hash = array (
      'id' => 1,
      'username' => 1,
      'password' => 1,
      'salt' => 1,
      'wallet' => 1,
    );

    public static $mixin_classes = array (
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'username',
      2 => 'password',
      3 => 'salt',
      4 => 'wallet',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'username',
      2 => 'password',
      3 => 'salt',
      4 => 'wallet',
    );

    public $label = 'User';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
        $this->relations = array( 
      'user_articles' => \Maghead\Schema\Relationship\HasMany::__set_state(array( 
      'data' => array( 
          'self_schema' => 'User\\Model\\UserSchema',
          'self_column' => 'id',
          'foreign_schema' => 'Article\\Model\\ArticlePurchaserSchema',
          'foreign_column' => 'user_id',
        ),
      'accessor' => 'user_articles',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => NULL,
    )),
      'articles' => \Maghead\Schema\Relationship\ManyToMany::__set_state(array( 
      'data' => array( 
          'relation_junction' => 'user_articles',
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
        $this->columns[ 'username' ] = new RuntimeColumn('username',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 128,
          'required' => true,
          'label' => 'Username',
        ),
      'name' => 'username',
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
      'label' => 'Username',
    ));
        $this->columns[ 'password' ] = new RuntimeColumn('password',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 128,
          'required' => true,
          'label' => 'Password',
        ),
      'name' => 'password',
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
      'label' => 'Password',
    ));
        $this->columns[ 'salt' ] = new RuntimeColumn('salt',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 32,
          'required' => true,
          'label' => 'Salt',
        ),
      'name' => 'salt',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 32,
      'required' => true,
      'label' => 'Salt',
    ));
        $this->columns[ 'wallet' ] = new RuntimeColumn('wallet',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 10,
          'decimals' => 2,
          'required' => true,
          'default' => 0,
          'label' => 'Wallet',
        ),
      'name' => 'wallet',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'double',
      'isa' => 'double',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 10,
      'decimals' => 2,
      'required' => true,
      'default' => 0,
      'label' => 'Wallet',
    ));
    }
}
