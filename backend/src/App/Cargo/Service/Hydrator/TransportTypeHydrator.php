<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\TransportType;

class TransportTypeHydrator
{
    public function hydrate(string $transportType): TransportType
    {
        return new TransportType(
            $transportType
            );
    }
}
