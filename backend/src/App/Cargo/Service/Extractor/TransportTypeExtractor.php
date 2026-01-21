<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\ValueObjects\TransportType;

class TransportTypeExtractor
{
    public function extract(TransportType $transportType): array
    {
        return [
            'uuid' => $transportType->uuid->toString(),
            'transportType' => $transportType->transportType,
        ];
    }
}