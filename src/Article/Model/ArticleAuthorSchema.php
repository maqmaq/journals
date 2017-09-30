<?php


namespace Article\Model;

use Maghead\Schema\DeclareSchema;

/**
 * Class ArticleAuthorSchema
 * @package Article\Model
 */
class ArticleAuthorSchema extends DeclareSchema
{

    public function schema()
    {
        $this->column('author_id')
            ->integer()
            ->unsigned()
            ->required()
            ->refer(AuthorSchema::class)
        ;
        $this->column('article_id')
            ->integer()
            ->unsigned()
            ->required()
            ->refer(ArticleSchema::class)
        ;

        $this->belongsTo('article', Article::class, 'id', 'article_id')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE')
        ;
        $this->belongsTo('author', Author::class, 'id', 'author_id')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE')
        ;
    }
}