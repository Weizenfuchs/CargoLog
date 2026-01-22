<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use App\Cargo\Controller\CargoController;
use Psr\Container\ContainerInterface;

class CargoListHandlerFactory
{
    public function __invoke(ContainerInterface $container): CargoListHandler
    {
        return new CargoListHandler(
            $container->get(CargoController::class)
        );
    }
}
