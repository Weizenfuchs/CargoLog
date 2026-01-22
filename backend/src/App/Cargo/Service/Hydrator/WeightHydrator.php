<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Weight;

class WeightHydrator
{
    public function hydrate(float $weight): Weight
    {
        return new Weight(
            $weight
            );
    }
}
