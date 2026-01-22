<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\CargoId;

class CargoIdHydrator
{
    public function hydrate(int $cargoId): CargoId
    {
        return new CargoId(
            $cargoId
            );
    }
}
