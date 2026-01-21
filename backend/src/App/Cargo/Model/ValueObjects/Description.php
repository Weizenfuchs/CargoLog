<?php

declare(strict_types=1);

namespace App\Cargo\Model\ValueObjects;

use Ramsey\Uuid\Uuid;

class Description
{
    public function __construct(
        public readonly Uuid $uuid,
        public readonly string $description
    ) {}
}
