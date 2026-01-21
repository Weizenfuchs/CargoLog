<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Amount;
use Ramsey\Uuid\Uuid;

class AmountHydrator
{
    public function hydrate(array $data): Amount
    {
        return new Amount(
            Uuid::fromString($data['uuid']),
            (int) $data['amount']
            );
    }
}
