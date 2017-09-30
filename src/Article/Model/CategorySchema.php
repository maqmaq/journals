<?php


namespace Article\Model;

use Maghead\Schema\DeclareSchema;

/**
 * Class CategorySchema
 * @package Article\Model
 */
class CategorySchema extends DeclareSchema
{

    public function schema()
    {
        $this->column('name')
            ->required()
            ->varchar(128);

        $this->many('articles', ArticleSchema::class, 'category_id', 'id');
    }
}