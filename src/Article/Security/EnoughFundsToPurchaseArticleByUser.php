<?php

namespace Article\Security;

use Article\Model\Article;
use User\Model\User;

/**
 * Class EnoughFundsToPurchaseArticleByUser
 * @package Article\Security
 */
class EnoughFundsToPurchaseArticleByUser extends \Core\Security\UserVoterAbstract
{
    /**
     * Enough funds in user's wallet to purchase
     */
    public const ENOUGH_FUNDS_TO_PURCHASE_BY_USER = 'enough_funds_to_purchase_by_user';

    /**
     * @param $subject
     * @param string $attribute
     * @return bool
     */
    function supports($subject, string $attribute): bool
    {
        if (!$subject instanceof Article) {
            return false;
        }

        return in_array($attribute, [self::ENOUGH_FUNDS_TO_PURCHASE_BY_USER]);

    }

    /**
     * @param $subject
     * @param string $attribute
     * @param User $user
     * @return bool
     */
    function voteOnAttribute($subject, string $attribute, User $user): bool
    {

        if ($attribute !== self::ENOUGH_FUNDS_TO_PURCHASE_BY_USER) {
            return false;
        }

        /** @var Article $subject */

        // check if amount in users wallet is greater than article's prive
        $price = $subject->getPrice();
        $userFunds = $user->getWallet();

        return (\bccomp($price, $userFunds, 2) !== 1);
    }
}