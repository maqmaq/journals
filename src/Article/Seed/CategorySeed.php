<?php

namespace Article\Seed;

use Maghead\Runtime\BaseSeed;

/**
 * Class CategorySeed
 * @package Article\Seed
 */
class CategorySeed extends BaseSeed
{

    /**
     *  Seeds categories for article
     */
    public static function seed()
    {
        $category1 = \Article\Model\Category::create(
            [
                'name' => 'category 1',
            ]
        );

        $category2 = \Article\Model\Category::create(
            [
                'name' => 'category 2',
            ]
        );

        $category3 = \Article\Model\Category::create(
            [
                'name' => 'category 3',
            ]
        );

        $category4 = \Article\Model\Category::create(
            [
                'name' => 'category 4',
            ]
        );
    }
}