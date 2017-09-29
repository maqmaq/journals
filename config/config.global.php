<?php

use Core\Dispatcher;
use function DI\object;
use Psr\Container\ContainerInterface;
use function DI\get;

$config = [
    'env' => ENV_PROD,
    'twig' => [
        'environment' => [
            'cache' => false,
            'auto_reload' => true,
            'debug' => true,
        ],
        'loader' => [
            'template_dir' => [
                sprintf('%s%s%sviews', SRC_DIR, 'Journal', DIRECTORY_SEPARATOR),
                sprintf('%s%s%sviews', SRC_DIR, 'App', DIRECTORY_SEPARATOR)
            ]
        ]
    ],
    'routes' => [
        [
            'GET',
            '/journals',
            'Journal\Controller\JournalController::listAction',
            'journal_list'
        ],
        [
            'GET',
            '/',
            'App\Controller\HomepageController::indexAction',
            'homepage'
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
        'App\Controller\*Controller' => DI\factory([\Core\Controller\ControllerFactory::class, 'create']),
    ];

return $config;