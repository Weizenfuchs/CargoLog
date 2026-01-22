<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\OrderDate;
use DateTime;

class OrderDateHydrator
{
    public function hydrate(DateTime $orderDate): OrderDate
    {
        return new OrderDate(
            $orderDate
            );
    }
}
