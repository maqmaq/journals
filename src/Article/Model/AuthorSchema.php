<?php

namespace Article\Model;

use Maghead\Schema\DeclareSchema;

/**
 * Class AuthorSchema
 * @package Article\Model
 */
class AuthorSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('first_name')
            ->varchar(128)
            ->required()
            ->label('First Name')
        ;
        $this->column('last_name')
            ->varchar(128)
            ->required()
            ->label('Last Name')
        ;

        $this->column('about')
            ->varchar(1024)
            ->label('About')
        ;

        $this->many('author_articles', ArticleAuthorSchema::class, 'author_id', 'id');
        $this->manyToMany('articles', 'author_articles', 'article');
    }
}