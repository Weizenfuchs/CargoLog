<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\Amount;

class AmountExtractor
{
    public function extract(Amount $amount): array
    {
        return [
            'uuid' => $amount->uuid->toString(),
            'amount' => $amount->amount,
        ];
    }
}