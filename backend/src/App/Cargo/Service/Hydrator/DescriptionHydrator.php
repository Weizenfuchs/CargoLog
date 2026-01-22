<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Description;

class DescriptionHydrator
{
    public function hydrate(string $description): Description
    {
        return new Description(
            $description
            );
    }
}
