<?php

$vendorAutoloadPath = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($vendorAutoloadPath)) {
    die('This script requires vendor autoload');
}

require_once $vendorAutoloadPath;

echo 'Hello there';