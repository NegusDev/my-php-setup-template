<?php
require_once 'src/require.php';

return
[
    'paths' => [
        'migrations' => __DIR__.'/src/db/migrations',
        'seeds' => __DIR__.'/src/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_DATABASE'),
            'user' =>  getenv('DB_USERNAME'),
            'pass' =>  getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];