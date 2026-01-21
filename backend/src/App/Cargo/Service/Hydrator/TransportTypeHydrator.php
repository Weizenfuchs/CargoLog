<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\TransportType;
use Ramsey\Uuid\Uuid;

class TransportTypeHydrator
{
    public function hydrate(array $data): TransportType
    {
        return new TransportType(
            Uuid::fromString($data['uuid']),
            (string) $data['transportType']
            );
    }
}
