<?php

$config = [
    'env' => ENV_PROD,
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

return $config;