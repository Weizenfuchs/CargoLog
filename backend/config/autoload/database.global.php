<?php

return [
    'db' => [
        'dsn'      => 'mysql:host=localhost;dbname=cargolog',
        'username' => 'admin',
        'password' => 'start123',
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ],
    ],
];
