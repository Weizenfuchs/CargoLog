<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

class CargoId
{
    public function __construct(
        public readonly int $cargoId
    ) {}
}
