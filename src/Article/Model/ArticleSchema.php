<?php

namespace Article\Model;

use Maghead\Schema\DeclareSchema;

class ArticleSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('title')
            ->varchar(128)
            ->required()
            ->label('Title')
        ;

        $this->column('shortDescription')
            ->varchar(255)
            ->required()
            ->label('Short description')
        ;

        $this->column('content')
            ->varchar(1024)
            ->label('Content')
        ;

        $this->column('price')
            ->decimal(10, 2)
            ->label('Price')
        ;

        /**
         * accessor , mapping self.id => ArticleAuthor.article_id
         *
         * link article => author_articles
         */
        $this->many('article_authors', ArticleAuthor::class, 'article_id', 'id');

        $this->manyToMany('authors', 'article_authors', 'author')
            ->filter(function ($collection) {
                return $collection;
            });
    }

}