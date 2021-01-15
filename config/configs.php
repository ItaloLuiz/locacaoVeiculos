<?php 

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = true;

$config = [
    'driver'    => 'mysql', // Db driver
    'host'      => 'localhost',
    'database'  => 'veiculos',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    'prefix'    => '', // Table prefix, optional
    'options'   => [ // PDO constructor options, optional
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

 new \Pixie\Connection('mysql', $config, 'QB');

