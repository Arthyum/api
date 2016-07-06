<?php
/**
 * Created by PhpStorm.
 * User: Rémi
 * Date: 19/06/2015
 * Time: 22:02
 */

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'oci8',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',  // Mandatory for PHPUnit testing
    'port'     => '8080',
    'dbname'   => 'ROOT',
    'user'     => 'REMI',
    'password' => '0000',
);

// enable the debug mode
//$app['debug'] = true;

// define log parameters
$app['monolog.level'] = 'INFO';
