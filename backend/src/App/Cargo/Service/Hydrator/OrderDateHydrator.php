<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\OrderDate;
use Ramsey\Uuid\Uuid;

class OrderDateHydrator
{
    public function hydrate(array $data): OrderDate
    {
        return new OrderDate(
            Uuid::fromString($data['uuid']),
            // FUCHS:TODO: Check DateTime Type Casting
            $data['orderDate']
            );
    }
}
