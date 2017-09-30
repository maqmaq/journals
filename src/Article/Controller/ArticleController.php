<?php

namespace Article\Controller;

use Article\Interactor\Article\GetById;
use Core\Controller\ControllerAbstract;
use Article\Interactor\Article\GetList;

/**
 * Class ArticleController
 * @package Article\Controller
 */
class ArticleController extends ControllerAbstract
{
    /** List action
     * @return string
     */
    public function listAction()
    {
        /** @var GetList $getListInteractor */
        $getListInteractor =  $this->getContainer()->get('article_interactor_get_list');
        $articles =  $getListInteractor->execute();

        $context = [
            'articles' => $articles
        ];

        return $this->render('Article/list.html.twig', $context);
    }

    /**
     * @param array $params
     * @return string
     */
    public function showAction($params = []) {

        $idArticle = $params['id'];

        /** @var GetById $getByIdInteractor */
        $getByIdInteractor =  $this->getContainer()->get('article_interactor_get_by_id');
        $article =  $getByIdInteractor->execute($idArticle);

        if ($article === false) {

            throw new ObjectNotFoundException();
        }
        $context = [
            'article' => $article
        ];
        return $this->render('Article/show.html.twig', $context);
    }
}