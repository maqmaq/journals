<?php


namespace Article\Seed;

use Maghead\Runtime\BaseSeed;

/**
 * Class AuthorSeed
 * @package Article\Seed
 */
class AuthorSeed extends BaseSeed
{

    /**
     *  Seeds authors of article
     */
    public static function seed()
    {
        $author1 = \Article\Model\Author::create(
            [
                'first_name' => 'name1',
                'last_name' => 'last name1',
                'about' => 'about1',
            ]
        );

        $author2 = \Article\Model\Author::create(
            [
                'first_name' => 'name2',
                'last_name' => 'last name2',
                'about' => 'about2',
            ]
        );

        $author3 = \Article\Model\Author::create(
            [
                'first_name' => 'name3',
                'last_name' => 'last name3',
                'about' => 'about3',
            ]
        );

        $author4 = \Article\Model\Author::create(
            [
                'first_name' => 'name4',
                'last_name' => 'last name4',
                'about' => 'about4',
            ]
        );

    }
}