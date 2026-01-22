<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

class TransportType
{
    public function __construct(
        public readonly string $transportType
    ) {}
}
