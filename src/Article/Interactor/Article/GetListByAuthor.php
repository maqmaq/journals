<?php


namespace Article\Interactor\Article;


use Article\Model\Author;

class GetListByAuthor
{

    /**
     * @return array
     */
    public function execute(Author $author)
    {
        return $author->getArticles();
    }
}