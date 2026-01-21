<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\OrderDate;

class OrderDateExtractor
{
    public function extract(OrderDate $orderDate): array
    {
        return [
            'uuid' => $orderDate->uuid->toString(),
            'orderDate' => $orderDate->orderDate,
        ];
    }
}