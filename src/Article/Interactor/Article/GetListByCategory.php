<?php


namespace Article\Interactor\Article;

use Article\Model\Category;

class GetListByCategory
{

    /**
     * @return array
     */
    public function execute(Category $category)
    {
        return $category->getArticles();
    }
}