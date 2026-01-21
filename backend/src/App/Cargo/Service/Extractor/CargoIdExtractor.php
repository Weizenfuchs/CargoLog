<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\CargoId;

class CargoIdExtractor
{
    public function extract(CargoId $cargoId): array
    {
        return [
            'uuid' => $cargoId->uuid->toString(),
            'cargoId' => $cargoId->cargoId,
        ];
    }
}