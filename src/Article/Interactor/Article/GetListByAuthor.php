<?php


namespace Article\Interactor\Article;


use Article\Model\Author;

/**
 * Class GetListByAuthor
 * @package Article\Interactor\Article
 */
class GetListByAuthor
{

    /**
     * @param Author $author
     * @return mixed
     */
    public function execute(Author $author)
    {
        return $author->getArticles();
    }
}