<?php

declare(strict_types=1);

namespace App\Cargo\Service\Extractor;

use App\Cargo\Model\Cargo;

class CargoExtractor
{
    public function __construct(
        public readonly CargoIdExtractor $cargoIdExtractor,
        public readonly AmountExtractor $amountExtractor,
        public readonly DescriptionExtractor $descriptionExtractor,
        public readonly WeightExtractor $weightExtractor,
        public readonly OrderDateExtractor $orderDateExtractor,
        public readonly TransportTypeExtractor $transportTypeExtractor
    ) {}

    public function extract(Cargo $cargo): array
    {
        return [
            'uuid' => $cargo->uuid->toString(),
            'amount' => $this->amountExtractor->extract($cargo->amount),
            'description' => $this->descriptionExtractor->extract($cargo->description),
            'weight' => $this->weightExtractor->extract($cargo->weight),
            'orderDate' => $this->orderDateExtractor->extract($cargo->orderDate),
            'transportType' => $this->transportTypeExtractor->extract($cargo->transportType),
        ];
    }
}
