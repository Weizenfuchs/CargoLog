<?php

declare(strict_types=1);

namespace App\Cargo\Model\Repository;

use PDO;
use App\Cargo\Model\Cargo;
use App\Cargo\Service\Extractor\CargoExtractor;
use App\Cargo\Service\Hydrator\CargoHydrator;

class CargoRepository
{
    public function __construct(
        private readonly PDO $pdo,
        private readonly CargoHydrator $cargoHydrator,
        private readonly CargoExtractor $cargoExtractor
        ) {}

    public function create(Cargo $cargo): bool
    {
        $cargoData = $this->cargoExtractor->extract($cargo);

        $sql = 'INSERT INTO cargo (amount, description, weight, order_date, transport_type) 
                VALUES (:amount, :description, :weight, :order_date, :transport_type)';

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':amount' => $cargoData['amount'],
            ':description' => $cargoData['description'],
            ':weight' => $cargoData['weight'],
            ':order_date' => $cargoData['order-date'],
            ':transport_type' => $cargoData['transport-type']
        ]);
    }

    public function findById(int $id): ?Cargo
    {
        // FUCHS:TODO: Implement
        return null;
    }

    public function findAll(): array
    {
        // FUCHS:TODO: Implement
        return [];
    }

    public function update(Cargo $cargo): bool
    {
        // FUCHS:TODO: Implement
        return false;
    }

    public function delete(int $id): bool
    {
        // FUCHS:TODO: Implement
        return false;
    }
}
