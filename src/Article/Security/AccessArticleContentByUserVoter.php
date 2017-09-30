<?php

namespace Article\Security;

use Article\Model\Article;
use User\Model\User;

class AccessArticleContentByUserVoter extends \Core\Security\UserVoterAbstract
{
    /**
     * View content for user attributes
     */
    public const VIEW_CONTENT = 'view_content';

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

        return in_array($attribute, [self::VIEW_CONTENT]);

    }

    /**
     * @param $subject
     * @param string $attribute
     * @param User $user
     * @return bool
     */
    function voteOnAttribute($subject, string $attribute, User $user): bool
    {
        if ($attribute !== self::VIEW_CONTENT) {
            // its not about view content so it's not my business
            return false;
        }

        /** @var Article $subject */
        if (bccomp($subject->getPrice(), 0, 2) !== 1) {
            // price is zero so its free
            return true;
        }

        // check if user is purchaser
        foreach ($subject->getPurchasers() as $purchaser) {
            /** @var User $purchaser */
            /** @var User $user */
            if ($purchaser->getId() === $user->getId()) {
                // user is one of owners
                return true;
            }
        }

        // this is the place where i start crying
        // collection if filtered fetch rows once again sa cant use collection to filter those with user id
        // so do not use filter on collection this time, you have been warned

        return false;
    }
}