<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Hydrator\CargoHydrator;
use PDO;
use Psr\Container\ContainerInterface;

class CargoRepositoryFactory
{
    public function __invoke(ContainerInterface $container): CargoRepository
    {
                error_log("CargoCreateRepository: Factory invoked");
        
        return new CargoRepository(
            $container->get(PDO::class),
            $container->get(CargoHydrator::class),
            $container->get(CargoExtractor::class)
        );
    }
}
