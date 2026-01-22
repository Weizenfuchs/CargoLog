<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\Weight;

class WeightExtractor
{
    public function extract(Weight $weight): float
    {
        return $weight->weight;
    }
}