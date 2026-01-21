<?php

declare(strict_types=1);

use Mezzio\Cors\Configuration\ConfigurationInterface;

return [
    ConfigurationInterface::CONFIGURATION_IDENTIFIER => [
        'allowed_origins' => [
            ConfigurationInterface::ANY_ORIGIN,
        ],
        'allowed_headers' => ['Content-Type', 'Authorization', 'Accept'],
        'allowed_max_age' => '600',
        'credentials_allowed' => false,
        'exposed_headers' => [],
    ],
];