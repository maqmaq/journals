<?php

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
            'template_dir' => [
                sprintf('%s%s%sviews', SRC_DIR, 'Article', DIRECTORY_SEPARATOR),
                sprintf('%s%s%sviews', SRC_DIR, 'App', DIRECTORY_SEPARATOR)
            ]
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
    ],
];

// dependency injection config
$config['di'] =
    [
        // core
        'core_router' => object(\Core\Router::class),
        'core_dispatcher' => object(\Core\Dispatcher::class)->constructor(get('code_service_controller_initializer')),
        'core_view' => object(\Core\View::class)->constructor(get('twig_environment')),
        'code_service_controller_initializer' => function (ContainerInterface $c) {
            // pass container to dispatcher
            return new \Core\Service\ControllerInitializer($c);
        },

        // twig
        'twig_loader' => object(Twig_Loader_Filesystem::class)->constructor($config['twig']['loader']['template_dir']),
        'twig_environment' => object(Twig_Environment::class)->constructor(get('twig_loader'), $config['twig']['environment']),

        // app
        '*\Controller\*Controller' => DI\factory([\Core\Controller\ControllerFactory::class, 'create']),

        // article
        'article_repository' => DI\factory([\Article\Model\Article::class, 'masterRepo']),
        'article_interactor_get_list' => object(\Article\Interactor\Article\GetList::class)->constructor(get('article_repository')),
        'article_interactor_get_by_id' => object(\Article\Interactor\Article\GetById::class)->constructor(get('article_repository')),
        'article_interactor_get_list_by_author' => object(\Article\Interactor\Article\GetListByAuthor::class),

        // author
        'author_repository' => DI\factory([\Article\Model\Author::class, 'masterRepo']),
        'author_interactor_get_list' => object(\Article\Interactor\Author\GetList::class)->constructor(get('author_repository')),
        'author_interactor_get_by_id' => object(\Article\Interactor\Author\GetById::class)->constructor(get('author_repository')),
    ];

return $config;