<?php

namespace Article\Model;

use Maghead\Schema\DeclareSchema;

/**
 * Class ArticleSchema
 * @package Article\Model
 */
class ArticleSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('title')
            ->varchar(128)
            ->required()
            ->label('Title');

        $this->column('short_description')
            ->varchar(255)
            ->required()
            ->label('Short description');

        $this->column('content')
            ->varchar(1024)
            ->label('Content');

        $this->column('price')
            ->double(10, 2)
            ->unsigned()
            ->default(0)
            ->label('Price');

        $this->column('category_id')
            ->integer()
            ->unsigned()
            ->default(null);

        /**
         * accessor , mapping self.id => ArticleAuthor.article_id
         *
         * link article => article_authors
         */
        $this->many('article_authors', ArticleAuthor::class, 'article_id', 'id');

        $this->manyToMany('authors', 'article_authors', 'author')
            ->filter(function ($collection) {
                return $collection;
            });

        $this->belongsTo('category', CategorySchema::class, 'id', 'category_id');

        /**
         * accessor , mapping self.id => ArticlePurchaser.article_id
         *
         * link article => article_purchasers
         */
        $this->many('article_purchasers', ArticlePurchaser::class, 'article_id', 'id');

        $this->manyToMany('purchasers', 'article_purchasers', 'purchaser')
            ->filter(function ($collection) {
                return $collection;
            });


    }

}