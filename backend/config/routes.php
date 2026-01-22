<?php

declare(strict_types=1);

use App\Cargo\Handler\CargoCreateHandler;
use App\Cargo\Handler\CargoListHandler;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 */
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->post(
        '/api/cargo',
        [
            // FUCHS:TODO: Implement CargoValidationMiddleware::class,
            CargoCreateHandler::class,
        ], 
        'cargo.create'
    );

    $app->get(
        '/api/cargo-list',
        [
            CargoListHandler::class,
        ],
        'cargo.list'
    );
};
