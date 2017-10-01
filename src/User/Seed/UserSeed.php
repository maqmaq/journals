<?php

namespace User\Seed;

use Maghead\Runtime\BaseSeed;

/**
 * Class UserSeed
 * @package User\Seed
 */
class UserSeed extends BaseSeed
{

    /**
     *  Seeds users
     */
    public static function seed()
    {
        $user1 = \User\Model\User::create(
            [
                'username' => 'user1',
                'password' => 'some-password-salted',
                'salt' => 'some-salt',
                'wallet' => 11.5,
            ]

        );

        $user2 = \User\Model\User::create(
            [
                'username' => 'user2',
                'password' => 'some-password-salted2',
                'salt' => 'some-salt2',
                'wallet' => 8,
            ]
        );

        $user3 = \User\Model\User::create(
            [
                'username' => 'user3',
                'password' => 'some-password-salted3',
                'salt' => 'some-salt3',
                'wallet' => 3.5,
            ]
        );

        $user4 = \User\Model\User::create(
            [
                'username' => 'user4',
                'password' => 'some-password-salted4',
                'salt' => 'some-salt4',
                'wallet' => 0.2,
            ]
        );
    }
}