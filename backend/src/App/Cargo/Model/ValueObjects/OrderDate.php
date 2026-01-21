<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

use DateTime;
use Ramsey\Uuid\Uuid;

class OrderDate
{
    public function __construct(
        public readonly Uuid $uuid,
        public readonly DateTime $orderDate
    ) {}
}
