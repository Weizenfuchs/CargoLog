<?php

declare(strict_types=1);

namespace App\Cargo\Service\Hydrator;

use App\Cargo\Model\Cargo;
use App\Cargo\Model\ValueObjects\Amount;
use App\Cargo\Model\ValueObjects\CargoId;
use App\Cargo\Model\ValueObjects\Description;
use App\Cargo\Model\ValueObjects\OrderDate;
use App\Cargo\Model\ValueObjects\TransportType;
use App\Cargo\Model\ValueObjects\Weight;
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

    public function hydrate(array $data): Cargo
    {
        return new Cargo(
            Uuid::fromString($data['uuid']),
            new CargoId($data['id']),
            $this->amountHydrator->hydrate($data['amount']),
            $this->descriptionHydrator->hydrate($data['description']),
            $this->weightHydrator->hydrate($data['weight']),
            $this->orderDateHydrator->hydrate($data['orderDate']),
            $this->transportTypeHydrator->hydrate($data['transportType'])
        );
    }
}
