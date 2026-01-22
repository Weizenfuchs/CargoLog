<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Extractor\AmountExtractor;
use App\Cargo\Service\Extractor\CargoIdExtractor;
use App\Cargo\Service\Extractor\DescriptionExtractor;
use App\Cargo\Service\Extractor\OrderDateExtractor;
use App\Cargo\Service\Extractor\TransportTypeExtractor;
use App\Cargo\Service\Extractor\WeightExtractor;
use Psr\Container\ContainerInterface;

class CargoExtractorFactory
{
    public function __invoke(ContainerInterface $container): CargoExtractor
    {
        return new CargoExtractor(
            $container->get(CargoIdExtractor::class),
            $container->get(AmountExtractor::class),
            $container->get(DescriptionExtractor::class),
            $container->get(WeightExtractor::class),
            $container->get(OrderDateExtractor::class),
            $container->get(TransportTypeExtractor::class)   
        );
    }
}
