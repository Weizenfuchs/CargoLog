<?php

declare(strict_types=1);

namespace App\Cargo\Model\Repository;

use PDO;
use App\Cargo\Model\Cargo;

class CargoRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Cargo $cargo): bool
    {
        $sql = 'INSERT INTO cargo (amount, description, weight, order_date, transport_type) 
                VALUES (:amount, :description, :weight, :order_date, :transport_type)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':amount', $cargo->getAmount());
        $stmt->bindParam(':description', $cargo->getDescription());
        $stmt->bindParam(':weight', $cargo->getWeight());
        $stmt->bindParam(':order_date', $cargo->getOrderDate());
        $stmt->bindParam(':transport_type', $cargo->getTransportType());

        return $stmt->execute();
    }

    public function findById(int $id): ?Cargo
    {
        $sql = 'SELECT * FROM cargo WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Cargo($data['id'], $data['amount'], $data['description'], $data['weight'], $data['order_date'], $data['transport_type']) : null;
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM cargo';
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cargoList = [];
        foreach ($result as $data) {
            $cargoList[] = new Cargo($data['id'], $data['amount'], $data['description'], $data['weight'], $data['order_date'], $data['transport_type']);
        }

        return $cargoList;
    }

    public function update(Cargo $cargo): bool
    {
        $sql = 'UPDATE cargo SET amount = :amount, description = :description, weight = :weight, order_date = :order_date, transport_type = :transport_type 
                WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':amount', $cargo->amount);
        $stmt->bindParam(':description', $cargo->getDescription());
        $stmt->bindParam(':weight', $cargo->getWeight());
        $stmt->bindParam(':order_date', $cargo->getOrderDate());
        $stmt->bindParam(':transport_type', $cargo->getTransportType());
        $stmt->bindParam(':id', $cargo->getId());

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM cargo WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}
