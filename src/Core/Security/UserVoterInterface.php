<?php


namespace Core\Security;

use User\Model\User;

interface UserVoterInterface
{

    /**
     * @param User $user
     * @param $subject
     * @param array $attributes
     * @return bool
     */
    function voteForSubjectAttributesByUser(User $user, $subject, array $attributes);

    /**
     * @param $subject
     * @param string $attribute
     * @return bool
     */
    function supports($subject, string $attribute):bool;

    /**
     * @param $subject
     * @param string $attribute
     * @param User $user
     * @return bool
     */
    function voteOnAttribute($subject, string $attribute, User $user):bool;
}