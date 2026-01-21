<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Weight;
use Ramsey\Uuid\Uuid;

class WeightHydrator
{
    public function hydrate(array $data): Weight
    {
        return new Weight(
            Uuid::fromString($data['uuid']),
            (float) $data['weight']
            );
    }
}
