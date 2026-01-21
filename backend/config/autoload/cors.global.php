<?php

declare(strict_types=1);

use Mezzio\Cors\Configuration\ConfigurationInterface;

return [
    ConfigurationInterface::CONFIGURATION_IDENTIFIER => [
        'allowed_origins' => [
            'http://localhost:4200', // Angular Dev Server
        ],
        'allowed_headers' => ['Content-Type', 'Authorization', 'Accept'],
        'allowed_max_age' => '600',
        'credentials_allowed' => false,
        'exposed_headers' => [],
    ],
];