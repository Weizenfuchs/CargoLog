<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use App\Cargo\Controller\CargoController;
use Psr\Container\ContainerInterface;

class CargoCreateHandlerFactory
{
    public function __invoke(ContainerInterface $container): CargoCreateHandler
    {
        return new CargoCreateHandler(
            $container->get(CargoController::class)
        );
    }
}
