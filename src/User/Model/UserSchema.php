<?php

namespace User\Model;

use Article\Model\ArticlePurchaserSchema;
use Maghead\Schema\DeclareSchema;

/**
 * @todo should extend core user
 * Class UserSchema
 * @package App\Model
 */
class UserSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('username')
            ->varchar(128)
            ->required()
            ->label('Username');

        $this->column('password')
            ->varchar(128)
            ->required()
            ->label('Password');

        $this->column('salt')
            ->varchar(32)
            ->required()
            ->label('Salt');

        $this->column('wallet')
            ->double(10, 2)
            ->required()
            ->unsigned()
            ->default(0)
            ->label('Wallet');

        $this->many('user_articles', ArticlePurchaserSchema::class, 'user_id', 'id');
        $this->manyToMany('articles', 'user_articles', 'article');
    }

}