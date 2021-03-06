<?php

namespace Article\Controller;


use Article\Interactor\Article\GetListByAuthor;
use Article\Interactor\Author\GetList;
use Core\Controller\ControllerAbstract;
use Core\Exception\ObjectNotFoundException;

/**
 * Class AuthorController
 * @package Article\Controller
 */
class AuthorController extends ControllerAbstract
{

    /** List action
     * @return string
     */
    public function listAction(): string
    {
        /** @var GetList $getListInteractor */
        $getListInteractor = $this->getContainer()->get('author_interactor_get_list');
        $authors = $getListInteractor->execute();

        $context = [
            'authors' => $authors
        ];

        return $this->render('Author/list.html.twig', $context);
    }

    /**
     * Index action
     * @param $params
     * @return string
     * @throws ObjectNotFoundException
     */
    public function showAction($params): string
    {
        $authorId = $params['id'];
        /** @var GetList $getListInteractor */
        $getByIdInteractor = $this->getContainer()->get('author_interactor_get_by_id');
        $author = $getByIdInteractor->execute($authorId);

        if ($author === false) {
            throw new ObjectNotFoundException();
        }

        /** @var GetListByAuthor $getListByAuthorInteractor */
        $getListByAuthorInteractor = $this->getContainer()->get('article_interactor_get_list_by_author');
        $articles = $getListByAuthorInteractor->execute($author);

        $context = [
            'author' => $author,
            'articles' => $articles,
        ];

        return $this->render('Author/show.html.twig', $context);
    }
}