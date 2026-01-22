<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

use DateTime;

class OrderDate
{
    public function __construct(
        public readonly DateTime $orderDate
    ) {}
}
