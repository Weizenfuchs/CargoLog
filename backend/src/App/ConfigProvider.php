<?php

declare(strict_types=1);

namespace App;

use App\Cargo\Controller\CargoController;
use App\Cargo\Handler\CargoCreateHandler;
use App\Cargo\Handler\CargoCreateHandlerFactory;
use App\Cargo\Controller\CargoControllerFactory;
use App\Cargo\Middleware\CargoExtractorFactory;
use App\Cargo\Middleware\CargoHydratorFactory;
use App\Cargo\Model\Repository\CargoRepositoryFactory;
use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Hydrator\CargoHydrator;
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
