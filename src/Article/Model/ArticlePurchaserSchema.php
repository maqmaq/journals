<?php

namespace Article\Model;

use User\Model\User;
use User\Model\UserSchema;
use Maghead\Schema\DeclareSchema;

/**
 * Class ArticlePurchaserSchema
 * @package Article\Model
 */
class ArticlePurchaserSchema extends DeclareSchema
{

    public function schema(): void
    {
        $this->column('user_id')
            ->integer()
            ->unsigned()
            ->required()
            ->refer(UserSchema::class);

        $this->column('article_id')
            ->integer()
            ->unsigned()
            ->required()
            ->refer(ArticleSchema::class);

        $this->belongsTo('article', Article::class, 'id', 'article_id')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

        $this->belongsTo('purchaser', User::class, 'id', 'user_id')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
    }
}