<?php

namespace Article\Interactor\Article\Purchase;

use Article\Model\Article;
use Maghead\Runtime\Repo;
use User\Model\User;

/**
 * Class PurchaseArticleByUser
 * @package Article\Interactor\Arcticle\Purchase
 */
class PurchaseArticleByUser
{

    /**
     * @var Repo
     */
    protected $userRepository;

    /**
     * PurchaseArticleByUser constructor.
     * @param Repo $userRepository
     */
    public function __construct(Repo $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Article $article
     * @param User $user
     * @return bool
     */
    public function execute(Article $article, User $user): bool
    {
        // begin transaction
        $this->userRepository->begin();
        try {

            $insertNewUserArticleStatus = $user->user_articles->create([
                'user_id' => $user->getId(),
                'article_id' => $article->getId()
            ]);

            if ($insertNewUserArticleStatus->error) {
                $this->userRepository->rollback();
                return false;
            }

            $updateUserStatus = $user->update(array('wallet' => $this->getCurrentFundBalance($user->getWallet(), $article->getPrice())));

            if ($updateUserStatus->error) {
                $this->userRepository->rollback();
                return false;
            }
            // everything is all right so do int
            $this->userRepository->commit();
        } catch (\Exception $e) {

            $this->userRepository->rollback();
            return false;
        }

        return true;
    }

    /**
     * @param $oldBalance
     * @param $price
     * @return string
     */
    protected function getCurrentFundBalance($oldBalance, $price): string
    {
        return bcsub($oldBalance, $price, 2);
    }
}