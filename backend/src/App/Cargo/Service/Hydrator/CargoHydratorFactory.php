<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use App\Cargo\Service\Hydrator\AmountHydrator;
use App\Cargo\Service\Hydrator\CargoHydrator;
use App\Cargo\Service\Hydrator\DescriptionHydrator;
use App\Cargo\Service\Hydrator\OrderDateHydrator;
use App\Cargo\Service\Hydrator\TransportTypeHydrator;
use App\Cargo\Service\Hydrator\WeightHydrator;
use Psr\Container\ContainerInterface;

class CargoHydratorFactory
{
    public function __invoke(ContainerInterface $container): CargoHydrator
    {
        return new CargoHydrator(
            $container->get(AmountHydrator::class),
            $container->get(DescriptionHydrator::class),
            $container->get(WeightHydrator::class),
            $container->get(OrderDateHydrator::class),
            $container->get(TransportTypeHydrator::class)   
        );
    }
}
