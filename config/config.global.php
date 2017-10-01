<?php

use App\Twig\EnvironmentFactory;
use Article\Interactor\Article\Purchase\PurchaseArticleByUser;
use Article\Security\AccessArticleContentByUserVoter;
use Article\Security\EnoughFundsToPurchaseArticleByUser;
use Core\Authentication\AuthenticatorInterface;
use Core\Security\UserAccessManagerFactory;
use function DI\object;
use Psr\Container\ContainerInterface;
use function DI\get;

$config = [
    'db' => [
        'config' => [
            'file' => CONFIG_DIR . '/db/database.yml'
        ]
    ],
    'env' => ENV_PROD,
    'twig' => [
        'environment' => [
            'cache' => false,
            'auto_reload' => true,
            'debug' => true,
        ],
        'loader' => [
            'template_dir' => (function ($arrayOfModules) {
                return array_map(function ($module) {
                    return sprintf('%s%s%sviews', SRC_DIR, $module, DIRECTORY_SEPARATOR);

                }, $arrayOfModules);
            })([
                'Article',
                'App',
                'User'
            ])
        ]
    ],
    'routes' => [
        // app
        [
            'GET',
            '/',
            'App\Controller\HomepageController::indexAction',
            'homepage'
        ],
        // articles
        [
            'GET',
            '/articles/list',
            'Article\Controller\ArticleController::listAction',
            'article_list'
        ],
        [
            'GET',
            '/articles/show/{id:number}',
            'Article\Controller\ArticleController::showAction',
            'article_show'
        ],
        // articles purchase
        [
            'GET',
            '/articles/purchase/{id:number}',
            'Article\Controller\ArticlePurchaseController::showAction',
            'article_purchase_show'
        ],
        // authors
        [
            'GET',
            '/authors/list',
            'Article\Controller\AuthorController::listAction',
            'author_list'
        ],
        [
            'GET',
            '/authors/show/{id:number}',
            'Article\Controller\AuthorController::showAction',
            'author_show'
        ],
        // categories
        [
            'GET',
            '/categories/list',
            'Article\Controller\CategoryController::listAction',
            'category_list'
        ],
        [
            'GET',
            '/categories/show/{id:number}',
            'Article\Controller\CategoryController::showAction',
            'category_show'
        ],
        // user
        [
            'GET',
            '/users/login',
            'User\Controller\AuthenticationController::loginAction',
            'user_authentication_login'
        ],
        [
            'GET',
            '/users/login/{id:number}',
            'User\Controller\AuthenticationController::simpleLoginAction',
            'user_authentication_simple_login'
        ],
        [
            'GET',
            '/users/list',
            'User\Controller\UserController::listAction',
            'user_list'
        ],
    ]
];


$createAccessManager = function ($voters, $attributes, ContainerInterface $c) {
    /** @var UserAccessManagerFactory $factory */
    $factory = $c->get('core_user_access_manager_factory');

    /** @var AuthenticatorInterface $authorizationInterface */
    $authorizationInterface = $user = $c->get('core_authentication_service');

    return $factory->create($voters, $attributes, $authorizationInterface);

};

// dependency injection config
$config['di'] =
    [
        // core
        'core_router' => object(\Core\Router::class),
        'core_dispatcher' => object(\Core\Dispatcher::class)->constructor(get('core_service_controller_initializer')),
        'core_view' => object(\Core\View::class)->constructor(get('twig_environment')),
        'core_session' => object(\Core\Session::class),
        'core_token_user_token_storage' => object(\Core\Token\UserTokenStorage::class)->constructor(get('user_repository')),
        'core_authentication_manager' => object(Core\Authentication\Manager\AuthenticationManager::class)->constructor(get('core_session')),
        'core_authentication_service' => object(\Core\Authentication\AuthenticationService::class)->constructor(get('core_authentication_manager'), get('core_token_user_token_storage')),
        'core_service_controller_initializer' => function (ContainerInterface $c) {
            // pass container to dispatcher
            return new \Core\Service\ControllerInitializer($c);
        },
        'core_user_access_manager_factory' => object(\Core\Security\UserAccessManagerFactory::class),
        'core_user_voter_decision_manager' => object(\Core\Security\UserVoterDecisionManager::class),
        'core_uri_resolver' => object(\Core\Router\UriResolver::class)->constructor(get('core_router')),

        // twig
        'twig_loader' => object(Twig_Loader_Filesystem::class)->constructor($config['twig']['loader']['template_dir']),
//        'twig_environment' => object(Twig_Environment::class)->constructor(get('twig_loader'), $config['twig']['environment']),
        'twig_environment_config' => $config['twig']['environment'],
        'twig_environment' => function (ContainerInterface $c) {

            $environmentFactory = new EnvironmentFactory($c);
            return $environmentFactory->create();
        },

        // app
        '*\Controller\*Controller' => DI\factory([\Core\Controller\ControllerFactory::class, 'create']),

        // article
        'article_repository' => DI\factory([\Article\Model\Article::class, 'masterRepo']),
        'article_interactor_get_list' => object(\Article\Interactor\Article\GetList::class)->constructor(get('article_repository')),
        'article_interactor_get_by_id' => object(\Article\Interactor\Article\GetById::class)->constructor(get('article_repository')),
        'article_interactor_get_list_by_author' => object(\Article\Interactor\Article\GetListByAuthor::class),
        'article_interactor_get_list_by_category' => object(\Article\Interactor\Article\GetListByCategory::class),
        'article_voter_article_content_by_user' => object(AccessArticleContentByUserVoter::class),
        'article_voter_enough_funds_to_purchase_article_by_user' => object(EnoughFundsToPurchaseArticleByUser::class),
        'article_access_manager_article_content_by_user' =>
            function (ContainerInterface $c) use ($createAccessManager) {
                $voters = [
                    $c->get('article_voter_article_content_by_user')
                ];
                $attributes = [AccessArticleContentByUserVoter::VIEW_CONTENT];

                return $createAccessManager($voters, $attributes, $c);
            },
        'article_access_manager_enough_funds_to_purchase_article_by_user' =>
            function (ContainerInterface $c) use ($createAccessManager) {
                $voters = [
                    $c->get('article_voter_enough_funds_to_purchase_article_by_user')
                ];
                $attributes = [EnoughFundsToPurchaseArticleByUser::ENOUGH_FUNDS_TO_PURCHASE_BY_USER];

                return $createAccessManager($voters, $attributes, $c);
            },

        'article_interactor_purchase_article_by_user' => object(PurchaseArticleByUser::class)->constructor(get('user_repository')),
        // author
        'author_repository' => DI\factory([\Article\Model\Author::class, 'masterRepo']),
        'author_interactor_get_list' => object(\Article\Interactor\Author\GetList::class)->constructor(get('author_repository')),
        'author_interactor_get_by_id' => object(\Article\Interactor\Author\GetById::class)->constructor(get('author_repository')),

        // category

        'category_repository' => DI\factory([\Article\Model\Category::class, 'masterRepo']),
        'category_interactor_get_list' => object(\Article\Interactor\Category\GetList::class)->constructor(get('category_repository')),
        'category_interactor_get_by_id' => object(\Article\Interactor\Category\GetById::class)->constructor(get('category_repository')),

        // user
        'user_repository' => DI\factory([\User\Model\User::class, 'masterRepo']),
        'user_interactor_get_list' => object(\User\Interactor\User\GetList::class)->constructor(get('user_repository')),
        'user_interactor_get_by_id' => object(\User\Interactor\User\GetById::class)->constructor(get('user_repository')),

    ];

return $config;