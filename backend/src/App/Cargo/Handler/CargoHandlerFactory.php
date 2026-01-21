<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use Psr\Container\ContainerInterface;

class CargoHandlerFactory
{
    public function __invoke(ContainerInterface $container): CargoHandler
    {
        return new CargoHandler();
    }
}
