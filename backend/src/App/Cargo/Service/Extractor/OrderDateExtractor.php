<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\OrderDate;
use DateTime;

class OrderDateExtractor
{
    public function extract(OrderDate $orderDate): string
    {
        return $orderDate->orderDate->format('Y-m-d');
    }
}