<?php

declare(strict_types=1);

namespace App\Cargo\Controller;

use App\Cargo\Model\Repository\CargoRepository;
use App\Cargo\Model\Cargo;
use App\Cargo\Service\Hydrator\CargoHydrator;

class CargoController
{
    public function __construct(
        private readonly CargoRepository $cargoRepository,
        private readonly CargoHydrator $cargoHydrator
        ) {}

    public function create(array $data): bool
    {
        $cargo = $this->cargoHydrator->hydrateNewCargoFromRequest($data);

        return $this->cargoRepository->create($cargo);
    }

    public function update(array $data): bool
    {
        // FUCHS:TODO: Implement
        return false;
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
