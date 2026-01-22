<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use App\Cargo\Controller\CargoController;
use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Service\Hydrator\CargoHydrator;
use Psr\Container\ContainerInterface;

class CargoControllerFactory
{
    public function __invoke(ContainerInterface $container): CargoController
    {
        error_log("CargoController: Factory invoked");

        return new CargoController(
            $container->get(CargoRepository::class),
            $container->get(CargoHydrator::class)
        );
    }
}
