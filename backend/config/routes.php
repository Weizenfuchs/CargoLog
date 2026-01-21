<?php

declare(strict_types=1);

use App\Cargo\Middleware\CargoCreateMiddleware;
use App\Handler\HomePageHandler;
use App\Handler\PingHandler;
use App\Cargo\Handler\CargoHandler;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', HomePageHandler::class, 'home');
    $app->get('/api/ping', PingHandler::class, 'api.ping');
    $app->post(
        '/api/cargo', 
        [
            CargoCreateMiddleware::class,
            CargoHandler::class,
        ], 
        'cargo.create'
    );
};
