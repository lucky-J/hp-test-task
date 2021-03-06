<?php

require_once __DIR__ . '/../vendor/autoload.php';

return [
    'database' => [
        'dsn' => \App\App::env('POSTGRE_DSN', ''),
    ]
];