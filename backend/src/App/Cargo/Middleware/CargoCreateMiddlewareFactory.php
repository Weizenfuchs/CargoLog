<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use Psr\Container\ContainerInterface;

class CargoCreateMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CargoCreateMiddleware
    {
        return new CargoCreateMiddleware();
    }
}
