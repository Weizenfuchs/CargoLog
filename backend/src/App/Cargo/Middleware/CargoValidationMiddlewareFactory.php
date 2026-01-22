<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use App\Cargo\Controller\CargoController;
use Psr\Container\ContainerInterface;

class CargoValidationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CargoValidationMiddleware
    {
        return new CargoValidationMiddleware(
            $container->get(CargoController::class)
        );
    }
}
