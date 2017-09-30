<?php


namespace Article\Controller;


use Article\Interactor\Article\GetById;
use Article\Interactor\Article\Purchase\PurchaseArticleByUser;
use Article\Model\Article;
use Article\Purchase\Status;
use Core\Authentication\AuthenticatorInterface;
use Core\Controller\ControllerAbstract;
use Core\Exception\ObjectNotFoundException;
use Core\Security\UserAccessManagerInterface;

/**
 * Class ArticlePurchaseController
 * @package Article\Controller
 */
class ArticlePurchaseController extends ControllerAbstract
{

    /**
     * Action shows message if user cannot purchase article or do purchase
     * @param $params
     * @return string
     * @throws ObjectNotFoundException
     */
    public function showAction($params)
    {
        $idArticle = $params['id'];

        // get article
        /** @var GetById $getByIdInteractor */
        $getByIdInteractor = $this->getContainer()->get('article_interactor_get_by_id');
        $article = $getByIdInteractor->execute($idArticle);

        if ($article === false) {
            throw new ObjectNotFoundException();
        }

        $template = 'Article/Purchase/show.html.twig';

        $context = [
            'article' => $article
        ];

        /** @var AuthenticatorInterface $authenticator */
        $authenticator = $this->getContainer()->get('core_authentication_service');
        if (!$authenticator->hasIdentity()) {
            return $this->render($template, array_merge($context, [
                'status' => Status::STATUS_AUTHENTICATION_REQUIRED
            ]));
        }

        /** @var Article $article */
        /** @var UserAccessManagerInterface $articleContentAccessManager */
        $articleContentAccessManager = $this->getContainer()->get('article_access_manager_article_content_by_user');



        // user already purchased article
        if ($articleContentAccessManager->can($article)) {
            return $this->render($template, array_merge($context, [
                'status' => Status::STATUS_ALREADY_PURCHASED
            ]));
        }

        // user has not enough funds to purchase
        $articlePurchaseAccessManager = $this->getContainer()->get('article_access_manager_enough_funds_to_purchase_article_by_user');
        if (!$articlePurchaseAccessManager->can($article)) {
            return $this->render($template, array_merge($context, [
                'status' => Status::STATUS_NOT_ENOUGH_FUNDS
            ]));
        }

        $user = $authenticator->getIdentity();

        // purchase for current user
        /** @var PurchaseArticleByUser $purchaseArticleByUser */
        $purchaseArticleByUser = $this->getContainer()->get('article_interactor_purchase_article_by_user');
        $purchasingResult = $purchaseArticleByUser->execute($article, $user);

        return $this->render($template, array_merge($context, [
            'status' => ($purchasingResult) ? Status::STATUS_PURCHASE_SUCCESS : Status::STATUS_PURCHASE_ERROR
        ]));


    }
}