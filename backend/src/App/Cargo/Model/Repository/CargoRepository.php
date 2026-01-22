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

        error_log(time() . ' ~> Creating cargo with data: ' . print_r($cargoData, true));

        $sql = 'INSERT INTO cargo (amount, description, weight, order_date, transport_type) 
                VALUES (:amount, :description, :weight, :order_date, :transport_type)';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':amount', $cargoData['amount']);
        $stmt->bindParam(':description', $cargoData['description']);
        $stmt->bindParam(':weight', $cargoData['weight']);
        $stmt->bindParam(':order_date', $cargoData['order_date']);
        $stmt->bindParam(':transport_type', $cargoData['transport_type']);

        return $stmt->execute($cargoData);
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
