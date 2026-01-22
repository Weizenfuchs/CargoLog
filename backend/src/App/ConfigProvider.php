<?php

declare(strict_types=1);

namespace App;

use App\Cargo\Controller\CargoController;
use App\Cargo\Handler\CargoCreateHandler;
use App\Cargo\Handler\CargoCreateHandlerFactory;
use App\Cargo\Middleware\CargoControllerFactory;
use App\Cargo\Middleware\CargoExtractorFactory;
use App\Cargo\Middleware\CargoHydratorFactory;
use App\Cargo\Middleware\CargoRepositoryFactory;
use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Hydrator\CargoHydrator;

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
