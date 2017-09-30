<?php


namespace Article\Interactor\Article;


use Article\Model\Author;

class GetListByAuthor
{

    /**
     * @param Author $author
     * @return array
     */
    public function execute(Author $author)
    {
        return $author->getArticles();
    }
}