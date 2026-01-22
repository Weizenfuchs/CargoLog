<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\ValueObjects\Amount;

class AmountHydrator
{
    public function hydrate(int $amount): Amount
    {
        return new Amount(
            $amount
            );
    }
}
