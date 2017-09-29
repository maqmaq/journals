<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CONFIG_DIR', ROOT . '../config' . DIRECTORY_SEPARATOR);

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
$containerBuilder->addDefinitions(CONFIG_DIR . 'di.php');
$container = $containerBuilder->build();


// run application1
$application = new \Core\Application($appConfig, $container);
$application->init();
$application->run();