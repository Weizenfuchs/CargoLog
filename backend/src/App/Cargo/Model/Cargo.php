<?php

declare(strict_types=1);

namespace App\Cargo\Model;

use App\Cargo\Model\ValueObjects\Amount;
use App\Cargo\Model\ValueObjects\CargoId;
use App\Cargo\Model\ValueObjects\Description;
use App\Cargo\Model\ValueObjects\OrderDate;
use App\Cargo\Model\ValueObjects\TransportType;
use App\Cargo\Model\ValueObjects\Weight;
use Ramsey\Uuid\Uuid;

class Cargo
{
    public function __construct(
        public readonly Uuid $uuid,
        public readonly ?CargoId $cargoId,
        public readonly Amount $amount,
        public readonly Description $description,
        public readonly Weight $weight,
        public readonly OrderDate $orderDate,
        public readonly TransportType $transportType
    ) {}
}
