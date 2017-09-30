<?php

namespace Article\Model;

use Maghead\Schema\DeclareSchema;

class AuthorSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('firstName')
            ->varchar(128)
            ->required()
            ->label('First Name')
        ;
        $this->column('lastName')
            ->varchar(128)
            ->required()
            ->label('Last Name')
        ;

        $this->column('about')
            ->varchar(1024)
            ->label('about')
        ;

        $this->many('author_articles', ArticleAuthorSchema::class, 'author_id', 'id');
        $this->manyToMany('articles', 'author_articles', 'article');
    }
}