<?php

return [
    'cors' => [
        'allowed_origins' => [
            'http://localhost:4200', // Angular dev server
        ],
        'allowed_headers' => ['Content-Type', 'Authorization'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
        'exposed_headers' => [],
        'max_age' => 600,
        'credentials_allowed' => true,
    ],
];
