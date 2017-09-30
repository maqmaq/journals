<?php

namespace Article\Controller;

use Article\Interactor\Article\GetListByCategory;
use Article\Interactor\Category\GetById;
use Article\Interactor\Category\GetList;
use Core\Controller\ControllerAbstract;
use Core\Exception\ObjectNotFoundException;

/**
 * Class CategoryController
 * @package Article\Controller
 */
class CategoryController extends ControllerAbstract
{

    /** List action
     * @return string
     */
    public function listAction()
    {
        /** @var GetList $getListInteractor */
        $getListInteractor = $this->getContainer()->get('category_interactor_get_list');
        $categories = $getListInteractor->execute();

        $context = [
            'categories' => $categories
        ];

        return $this->render('Category/list.html.twig', $context);
    }

    /**
     * Index action
     * @param $params
     * @return string
     * @throws ObjectNotFoundException
     */
    public function showAction($params)
    {

        $authorId = $params['id'];
        /** @var GetById $getListInteractor */
        $getByIdInteractor = $this->getContainer()->get('category_interactor_get_by_id');
        $category = $getByIdInteractor->execute($authorId);

        if ($category === false) {
            throw new ObjectNotFoundException();
        }

        /** @var GetListByCategory $getListByCategoryInteractor */
        $getListByCategoryInteractor = $this->getContainer()->get('article_interactor_get_list_by_category');
        $articles = $getListByCategoryInteractor->execute($category);

        $context = [
            'category' => $category,
            'articles' => $articles,
        ];

        return $this->render('Category/show.html.twig', $context);
    }
}