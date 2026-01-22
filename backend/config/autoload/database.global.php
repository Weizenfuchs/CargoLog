return [
    'db' => [
        'dsn'      => 'mysql:host=localhost;dbname=cargolog',
        'username' => 'root',
        'password' => 'password123',
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ],
    ],
];
