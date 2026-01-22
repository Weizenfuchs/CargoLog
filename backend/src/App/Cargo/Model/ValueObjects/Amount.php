<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

class Amount
{
    public function __construct(
        public readonly int $amount
    ) {}
}
