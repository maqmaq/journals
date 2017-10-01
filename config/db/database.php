<?php return array (
  'cli' => 
  array (
    'bootstrap' => 'vendor/autoload.php',
  ),
  'schema' => 
  array (
    'auto_id' => 1,
    'paths' => 
    array (
      0 => 'src/Article/Model',
      1 => 'src/App/Model',
      2 => 'src/User/Model',
    ),
  ),
  'instance' => 
  array (
    'local' => 
    array (
      'driver' => 'mysql',
      'host' => 'mysql',
      'user' => 'journals',
      'password' => 'journals',
      'query_options' => 
      array (
      ),
      'connection_options' => 
      array (
        1002 => 'SET NAMES utf8',
      ),
      'dsn' => 'mysql:host=mysql',
    ),
  ),
  'databases' => 
  array (
    'master' => 
    array (
      'driver' => 'mysql',
      'database' => 'journals',
      'host' => 'mysql',
      'user' => 'journals',
      'password' => 'journals',
      'query_options' => 
      array (
      ),
      'connection_options' => 
      array (
        1002 => 'SET NAMES utf8',
      ),
      'dsn' => 'mysql:host=mysql;dbname=journals',
    ),
  ),
  'seeds' => 
  array (
    0 => 'User\\Seed::UserSeed',
    1 => 'Article\\Seed::ArticleSeed',
  ),
);