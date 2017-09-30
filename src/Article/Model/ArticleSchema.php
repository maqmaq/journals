<?php

namespace Article\Model;

use Maghead\Schema\DeclareSchema;

class ArticleSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('title')
            ->varchar(128)
            ->label('title')
        ;

        $this->column('shortDescription')
            ->varchar(255)
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
    }
}