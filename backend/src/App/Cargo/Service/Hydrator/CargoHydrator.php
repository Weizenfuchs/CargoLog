<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\Cargo;
use DateTime;
use Ramsey\Uuid\Uuid;

class CargoHydrator
{
    public function __construct(
        public readonly AmountHydrator $amountHydrator,
        public readonly DescriptionHydrator $descriptionHydrator,
        public readonly WeightHydrator $weightHydrator,
        public readonly OrderDateHydrator $orderDateHydrator,
        public readonly TransportTypeHydrator $transportTypeHydrator
    ) {}

    public function hydrateNewCargoFromRequest(array $data): Cargo
    {
        return new Cargo(
            cargoId: null,
            amount: $this->amountHydrator->hydrate($data['amount']),
            description: $this->descriptionHydrator->hydrate($data['description']),
            weight: $this->weightHydrator->hydrate($data['weight']),
            orderDate: $this->orderDateHydrator->hydrate(DateTime::createFromFormat('Y-m-d', $data['order-date'])),
            transportType: $this->transportTypeHydrator->hydrate($data['transport-type'])
        );
    }

    // FUCHS:TODO: public function hydrateExistingCargoFromRequest(array $data): Cargo

    // FUCHS:TODO: public function hydrateFromDatabase(array $data): Cargo
}
