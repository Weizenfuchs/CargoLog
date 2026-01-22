<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

class Weight
{
    public function __construct(
        public readonly float $weight
    ) {}
}
