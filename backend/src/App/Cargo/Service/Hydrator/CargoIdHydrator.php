<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\CargoId;
use Ramsey\Uuid\Uuid;

class CargoIdHydrator
{
    public function hydrate(array $data): CargoId
    {
        return new CargoId(
            Uuid::fromString($data['uuid']),
            (int) $data['cargoId']
            );
    }
}
