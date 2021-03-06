<?php

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CONFIG_DIR', ROOT . '../config' . DIRECTORY_SEPARATOR);
define('CACHE_DIR', ROOT . '../cache' . DIRECTORY_SEPARATOR);
define('SRC_DIR', ROOT . '../src' . DIRECTORY_SEPARATOR);

define('ENV_DEV', 'dev');
define('ENV_PROD', 'prod');

// load vendor autoload
$vendorAutoloadPath = ROOT . '../vendor/autoload.php';

if (!file_exists($vendorAutoloadPath)) {
    die('This script requires vendor autoload');
}

require_once $vendorAutoloadPath;

// merge configs
$appConfig = require CONFIG_DIR . 'config.global.php';
$localAppConfigPath = CONFIG_DIR . 'config.local.php';

if (file_exists($localAppConfigPath)) {
    $appConfig = \Knlv\config_merge(CONFIG_DIR, array('global', 'local'));
}

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions($appConfig['di']);
$container = $containerBuilder->build();

// run application1
$application = new \Core\Application($appConfig, $container);
$application->init();
$application->run();