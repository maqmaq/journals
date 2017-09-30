<?php


namespace Core\Security;
use User\Model\User;

/**
 * Class UserVoterAbstract
 * @package Core\Security
 */
abstract class UserVoterAbstract
{

    /**
     * @param User $user
     * @param $subject
     * @param array $attributes
     * @return bool
     */
    public function voteForSubjectAttributesByUser(User $user, $subject, array $attributes):bool
    {
        foreach ($attributes as $attribute) {
            if (!$this->supports($subject, $attribute)) {
                continue;
            }

            if ($this->voteOnAttribute($subject, $attribute, $user)) {
                // grant access as soon as at least one attribute returns a positive response
                return true;
            }
        }
        return false;
    }

    /**
     * @param $object
     * @param string $attribute
     * @return bool
     */
    abstract function supports($subject, string $attribute):bool;

    /**
     * @param $object
     * @param string $attribute
     * @param User $user
     * @return bool
     */
    abstract function voteOnAttribute($subject, string $attribute, User $user):bool;

}