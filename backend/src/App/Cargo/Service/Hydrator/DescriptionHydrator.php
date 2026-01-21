<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Description;
use Ramsey\Uuid\Uuid;

class DescriptionHydrator
{
    public function hydrate(array $data): Description
    {
        return new Description(
            Uuid::fromString($data['uuid']),
            (string) $data['description']
            );
    }
}
