<?php

namespace Article\Controller;

use Core\Controller\ControllerAbstract;
use Article\Interactor\GetList;

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

        $getByIdInteractor =  $this->getContainer()->get('article_interactor_get_by_id');
        $article =  $getByIdInteractor->execute($idArticle);

        // @todo return 404 if not found

        $context = [
            'article' => $article
        ];
        return $this->render('Article/show.html.twig', $context);
    }
}