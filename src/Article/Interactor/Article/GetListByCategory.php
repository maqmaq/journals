<?php


namespace Article\Interactor\Article;

use Article\Model\Category;

/**
 * Class GetListByCategory
 * @package Article\Interactor\Article
 */
class GetListByCategory
{

    /**
     * @param Category $category
     * @return array
     */
    public function execute(Category $category): array
    {
        return $category->getArticles();
    }
}