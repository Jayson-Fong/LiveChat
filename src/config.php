<?php

$config = [
    /** @see \Medoo\Medoo */
    'database' => [
        'type' => 'mysql',
        'host' => 'localhost',
        'database' => 'example',
        'username' => 'root',
        'password' => 'password',
    ],
    'locales' => [
        'en-US'
    ],
    'template' => [
        'templateDir' => 'templates',
        'cacheDir' => 'cache',
        'useCache' => false
    ],
    'locale' => 'en-US',
    'baseUrl' => 'http://localhost:8000',
    'prettyUrl' => false,
    'installLock' => false
];