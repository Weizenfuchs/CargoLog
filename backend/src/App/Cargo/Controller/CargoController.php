<?php

declare(strict_types=1);

namespace App\Cargo\Controller;

use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Model\Cargo;
use Ramsey\Uuid\Uuid;

class CargoController
{
    private CargoRepository $cargoRepository;

    public function __construct(CargoRepository $cargoRepository)
    {
        $this->cargoRepository = $cargoRepository;
    }

    public function create(array $data): bool
    {
        $cargo = new Cargo(
            uuid: Uuid::uuid4(),
            cargoId: null,
            amount: new Amount(Uuid::uuid4(), (int) $data['amount']),
            description: new Description(Uuid::uuid4(), (string) $data['description']),
            weight: new Weight(Uuid::uuid4(), (float) $data['weight']),
            orderDate: new OrderDate(Uuid::uuid4(), DateTime::createFromFormat('d-m-Y', $data['orderDate'])),
            transportType: new TransportType(Uuid::uuid4(), (string) $data['transportType'])
        );

        return $this->cargoRepository->create($cargo);
    }

    public function update(array $data): bool
    {
        $cargo = new Cargo($data['id'], $data['amount'], $data['description'], $data['weight'], $data['order_date'], $data['transport_type']);
        return $this->cargoRepository->update($cargo);
    }

    public function getCargoByCargoId(int $cargoId): ?Cargo
    {
        return $this->cargoRepository->findById($cargoId);
    }

    public function getAllCargo(): array
    {
        return $this->cargoRepository->findAll();
    }

    public function deleteCargo(int $id): bool
    {
        return $this->cargoRepository->delete($id);
    }
}
