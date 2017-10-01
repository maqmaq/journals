<?php


namespace Article\Seed;

use Article\Model\Article;
use App\Seed\BaseSeed;
use Article\Model\Author;
use Article\Model\Category;
use Maghead\Runtime\Result;
use User\Model\User;

/**
 * Class ArticleSeed
 * @package Article\Seed
 */
class ArticleSeed extends BaseSeed
{

    /**
     *  Seeds articles
     */
    public static function seed()
    {
        self::createArticleWithOneAuthorWithoutCategory();
        self::createArticleWithTwoAuthorsWithoutCategory();
        self::createArticleWithOneAuthorWithCategory();
        self::createArticleWithOneAuthorWithCategoryPurchasedByUser();
    }

    /**
     * Seeds article with one author
     */
    protected static function createArticleWithOneAuthorWithoutCategory()
    {
        /** @var Result $articleCreateResult */;
        $articleCreateResult = self::createOrThrowRuntimeException(\Article\Model\Article::create(
            [
                'title' => 'Healthy dish you can preapare quickly',
                'short_description' => 'Nulla vestibulum nec, dignissim in, cursus molestie. Donec est. Integer neque quis porta nisl. Nam pulvinar, quam molestie ultricies vitae.',
                'content' => 'Lorem ipsum primis in erat consectetuer viverra semper orci, viverra lacinia. Vestibulum aliquam lacinia, risus nunc, placerat ornare dapibus. Aenean et netus et velit. Duis hendrerit magna sapien, tempus ac, dictum sed, vestibulum vehicula. Etiam leo at risus commodo ante. Curabitur elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi sem dolor eu wisi. Suspendisse at lorem non orci. Proin gravida sit amet nunc volutpat a, pellentesque sed, sodales pede. Duis vulputate nunc. Praesent tortor. Donec vitae felis. Mauris leo. Donec molestie a, tellus. Suspendisse at magna. Etiam vestibulum tristique vitae, lectus. Nam suscipit, risus velit, a dolor lacus, congue quis, dictum id, eleifend purus scelerisque odio sit amet felis odio vitae fringilla fringilla eget, nulla. Nunc justo ac posuere cubilia Curae, Sed vehicula wisi, aliquam arcu. Sed feugiat sapien, congue odio non arcu. Nam risus et ultrices iaculis. Curabitur arcu elit, dictum ut, diam.',
                'price' => 0,
            ]
        ));

        $articleWithOneAuthor = Article::load($articleCreateResult->key);

        $authorCreateResult = self::createOrThrowRuntimeException(\Article\Model\Author::create(
            [
                'first_name' => 'author name1',
                'last_name' => 'author last name1',
                'about' => 'author about1',
            ]
        ));

        $author = Author::load($authorCreateResult->key);

        self::createOrThrowRuntimeException($articleWithOneAuthor->article_authors->create([
            'author_id' => $author->getId(),
            'article_id' => $articleWithOneAuthor->getId(),
        ]));
    }

    /**
     * Seeds article with two authors
     */
    protected static function createArticleWithTwoAuthorsWithoutCategory()
    {
        /** @var Result $articleCreateResult */;
        $articleCreateResult = self::createOrThrowRuntimeException(\Article\Model\Article::create(
            [
                'title' => 'Germanium-based CPU cores',
                'short_description' => 'Cum sociis natoque penatibus et ultrices urna, pellentesque tincidunt, velit in dui. Lorem ipsum aliquet elit. Mauris luctus et magnis.',
                'content' => 'Curae, Mauris vel risus. Nulla facilisi. Nullam et lacus a mauris. Nunc ultricies tortor id tortor quis massa ac ipsum. Proin cursus, mi quis viverra elit. Nunc consectetuer adipiscing ornare. Nam molestie. Quisque pharetra, urna ut urna mauris, consectetuer nisl. Fusce mollis, orci a augue. Nam scelerisque pede ac nisl. Morbi fermentum leo facilisis dui ligula, quis eleifend eget, nunc. Nunc velit non sem. Nam lorem eu eros. Pellentesque laoreet metus vitae tellus consectetuer adipiscing quam sagittis eget, bibendum ac, ultricies vehicula, dui gravida vitae, lectus. Curabitur commodo.',
                'price' => 1.5,
            ]
        ));

        $articleWithTwoAuthors = Article::load($articleCreateResult->key);

        $author1CreateResult = self::createOrThrowRuntimeException(\Article\Model\Author::create(
            [
                'first_name' => 'author name2',
                'last_name' => 'author last name2',
                'about' => 'author about2',
            ]
        ));

        $author1 = Author::load($author1CreateResult->key);
        self::createOrThrowRuntimeException($articleWithTwoAuthors->article_authors->create([
            'author_id' => $author1->getId(),
            'article_id' => $articleWithTwoAuthors->getId(),
        ]));

        $author2CreateResult = self::createOrThrowRuntimeException(\Article\Model\Author::create(
            [
                'first_name' => 'author name3',
                'last_name' => 'author last name3',
                'about' => 'author about3',
            ]
        ));

        $author2 = Author::load($author2CreateResult->key);
        self::createOrThrowRuntimeException($articleWithTwoAuthors->article_authors->create([
            'author_id' => $author2->getId(),
            'article_id' => $articleWithTwoAuthors->getId(),
        ]));
    }

    /**
     * Seeds article with one author and category
     */
    protected static function createArticleWithOneAuthorWithCategory()
    {
        $categoryCreateResult = self::createOrThrowRuntimeException(\Article\Model\Category::create(
            [

                'name' => 'Science',
            ]
        ));

        $category = Category::load($categoryCreateResult->key);

        /** @var Result $articleCreateResult */;
        $articleCreateResult = self::createOrThrowRuntimeException(\Article\Model\Article::create(
            [
                'title' => 'A Pyramid? Found one more!',
                'short_description' => 'Morbi vitae dui odio nonummy eget, dignissim porttitor, arcu nunc ut erat. Duis ut aliquet ipsum sit amet, ante. Morbi.',
                'content' => 'Aenean feugiat nec, nibh. Donec dolor nibh, dignissim tempor, pede urna mi, nec sapien mauris lacus a blandit malesuada. Suspendisse vel leo. In euismod. Integer lacinia id, sapien. Maecenas sapien quis consectetuer dignissim, lorem fermentum mi, viverra ligula. Phasellus ac lectus. Sed adipiscing risus at tortor. Integer neque ut venenatis augue quis pellentesque consectetuer, augue at consequat tortor, pretium vitae, tortor. Proin dui at sapien. Maecenas imperdiet convallis. Fusce blandit justo, posuere cubilia Curae, Vivamus semper quis, tellus. Aliquam nulla. Aliquam ultricies lobortis sed, ullamcorper varius nunc, tempus nunc. Ut sodales, dictum sed, aliquet elit, varius risus metus gravida non, nunc. Sed aliquet quis, ornare quam. Vestibulum ullamcorper augue, sagittis urna. Donec odio sit amet, sodales nulla.',
                'price' => 5.75,
                'category_id' => $category->getId()
            ]
        ));

        $articleWithOneAuthor = Article::load($articleCreateResult->key);

        $authorCreateResult = self::createOrThrowRuntimeException(\Article\Model\Author::create(
            [
                'first_name' => 'author name 4',
                'last_name' => 'author last name4',
                'about' => 'author about4',
            ]
        ));

        $author = Author::load($authorCreateResult->key);

        self::createOrThrowRuntimeException($articleWithOneAuthor->article_authors->create([
            'author_id' => $author->getId(),
            'article_id' => $articleWithOneAuthor->getId(),
        ]));
    }

    /**
     * Seeds article with oute auhtos with category purchased by user
     */
    protected static function createArticleWithOneAuthorWithCategoryPurchasedByUser()
    {
        $categoryCreateResult = self::createOrThrowRuntimeException(\Article\Model\Category::create(
            [
                'name' => 'Archeology',
            ]
        ));

        $category = Category::load($categoryCreateResult->key);

        /** @var Result $articleCreateResult */;
        $articleCreateResult = self::createOrThrowRuntimeException(\Article\Model\Article::create(
            [
                'title' => 'The prosecution just couldn\'t handle the truth',
                'short_description' => 'Vestibulum convallis nisl, sollicitudin sed, fermentum facilisis. Maecenas fermentum quis, velit. Duis lobortis, varius sit amet, felis. Pellentesque porta tincidunt.',
                'content' => 'Mauris vestibulum ligula. Ut sagittis, nunc semper feugiat. Cum sociis natoque penatibus et eros orci luctus et lectus. Curabitur placerat, nisl ac odio eget velit wisi, ullamcorper mauris. Etiam ac ligula. Lorem ipsum aliquet feugiat nec, scelerisque arcu. Sed mauris sit amet, vulputate luctus. Sed fringilla sollicitudin, odio vitae velit sit amet, massa. Nunc gravida. Suspendisse est. Lorem ipsum dolor ut magna. Quisque vestibulum. Nulla consequat sed, ullamcorper ac, laoreet a, ligula. Aenean non felis. Pellentesque at ipsum. Aliquam consequat eu, luctus bibendum. Nulla eleifend purus consectetuer massa. Proin sed porta turpis velit, scelerisque odio eget augue commodo volutpat quam nibh faucibus in, dapibus sit amet, iaculis ante, tincidunt quis, ultricies porta. Vivamus pede. Vestibulum aliquam enim. Nunc leo.',
                'price' => 0,
                'category_id' => $category->getId()
            ]
        ));

        $articleWithOneAuthor = Article::load($articleCreateResult->key);

        $authorCreateResult = self::createOrThrowRuntimeException(\Article\Model\Author::create(
            [
                'first_name' => 'author name 4',
                'last_name' => 'author last name4',
                'about' => 'author about4',
            ]
        ));

        $author = Author::load($authorCreateResult->key);

        self::createOrThrowRuntimeException($articleWithOneAuthor->article_authors->create([
            'author_id' => $author->getId(),
            'article_id' => $articleWithOneAuthor->getId(),
        ]));

        $userCreateResult = self::createOrThrowRuntimeException(\User\Model\User::create(
            [
                'username' => 'user-article-owner',
                'password' => 'some-password-salted',
                'salt' => 'some-salt',
                'wallet' => 2.4,
            ]
        ));

        $owner = User::load($userCreateResult->key);

        self::createOrThrowRuntimeException($articleWithOneAuthor->article_purchasers->create([
            'user_id' => $owner->getId(),
            'article_id' => $articleWithOneAuthor->getId(),
        ]));

    }
}

