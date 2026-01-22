<?php

declare(strict_types=1);

use App\Cargo\Controller\CargoController;
use App\Cargo\Handler\CargoCreateHandler;
use App\Cargo\Middleware\CargoControllerFactory;
use App\Cargo\Middleware\CargoHydratorFactory;
use App\Cargo\Middleware\CargoRepositoryFactory;
use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Service\Hydrator\CargoHydrator;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            CargoCreateHandler::class => CargoCreateHandler::class,
            CargoController::class => CargoControllerFactory::class,
            CargoHydrator::class => CargoHydratorFactory::class,
            CargoRepository::class => CargoRepositoryFactory::class,
        ],
    ],
];
