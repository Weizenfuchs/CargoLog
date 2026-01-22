<?php

declare(strict_types=1);

namespace App;

use App\Cargo\Controller\CargoController;
use App\Cargo\Handler\CargoCreateHandler;
use App\Cargo\Handler\CargoCreateHandlerFactory;
use App\Cargo\Controller\CargoControllerFactory;
use App\Cargo\Service\Extractor\CargoExtractorFactory;
use App\Cargo\Service\Hydrator\CargoHydratorFactory;
use App\Cargo\Model\Repository\CargoRepositoryFactory;
use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Model\ValueObjects\CargoId;
use App\Cargo\Model\ValueObjects\Description;
use App\Cargo\Model\ValueObjects\TransportType;
use App\Cargo\Service\Extractor\AmountExtractor;
use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Extractor\CargoIdExtractor;
use App\Cargo\Service\Extractor\DescriptionExtractor;
use App\Cargo\Service\Extractor\OrderDateExtractor;
use App\Cargo\Service\Extractor\TransportTypeExtractor;
use App\Cargo\Service\Extractor\WeightExtractor;
use App\Cargo\Service\Hydrator\AmountHydrator;
use App\Cargo\Service\Hydrator\CargoHydrator;
use App\Cargo\Service\Hydrator\CargoIdHydrator;
use App\Cargo\Service\Hydrator\DescriptionHydrator;
use App\Cargo\Service\Hydrator\OrderDateHydrator;
use App\Cargo\Service\Hydrator\TransportTypeHydrator;
use App\Cargo\Service\Hydrator\WeightHydrator;
use PDO;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                /* Value Object Hydrators */
                AmountHydrator::class => AmountHydrator::class,
                CargoIdHydrator::class => CargoIdHydrator::class,
                DescriptionHydrator::class => DescriptionHydrator::class,
                OrderDateHydrator::class => OrderDateHydrator::class,
                TransportTypeHydrator::class => TransportTypeHydrator::class,
                WeightHydrator::class => WeightHydrator::class,
                /* Value Object Extractors */
                AmountExtractor::class => AmountExtractor::class,
                CargoIdExtractor::class => CargoIdExtractor::class,
                DescriptionExtractor::class => DescriptionExtractor::class,
                OrderDateExtractor::class => OrderDateExtractor::class,
                TransportTypeExtractor::class => TransportTypeExtractor::class,
                WeightExtractor::class => WeightExtractor::class,
            ],
            'factories'  => [
                CargoCreateHandler::class => CargoCreateHandlerFactory::class,
                CargoController::class => CargoControllerFactory::class,
                CargoHydrator::class => CargoHydratorFactory::class,
                CargoExtractor::class => CargoExtractorFactory::class,
                CargoRepository::class => CargoRepositoryFactory::class,
                // PDO-Factory hinzufügen
                PDO::class => function (\Psr\Container\ContainerInterface $container) {
                $dbConfig = $container->get('config')['db']; // Annahme: DB-Konfiguration existiert
                return new PDO(
                    $dbConfig['dsn'],
                    $dbConfig['username'],
                    $dbConfig['password'],
                    $dbConfig['options'] ?? []
                );
            },
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
