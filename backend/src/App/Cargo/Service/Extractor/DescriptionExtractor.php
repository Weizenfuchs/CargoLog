<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\Description;

class DescriptionExtractor
{
    public function extract(Description $description): string
    {
        return $description->description;
    }
}