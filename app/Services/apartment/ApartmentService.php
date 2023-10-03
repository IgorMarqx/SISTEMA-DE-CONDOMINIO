<?php

namespace App\Services\apartment;

use App\Models\Apartment;
use App\Repositories\apartment\ApartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ApartmentService
{
    private ApartmentRepositoryInterface $apartmentRepository;

    public function __construct(ApartmentRepositoryInterface $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function getAll(): Collection
    {
        return $this->apartmentRepository->getAll();
    }

    public function storeApartment($data): Apartment
    {
        return $this->apartmentRepository->storeApartment($data);
    }

    public function findApartmentById($id): Collection|Apartment|null
    {
        $apartment = $this->apartmentRepository->findApartmentById($id);

        if (!$apartment) {
            return null;
        }

        return $apartment;
    }

    public function updateApartment($data, $id): bool|null
    {
        $apartment = $this->apartmentRepository->findApartmentById($id);

        if (!$apartment) {
            return null;
        }

        return $this->apartmentRepository->updateApartment($apartment, [
            'identify' => $data['indentify'],
            'condominium_id' => $data['condominium_id'],
        ]);
    }

    public function deleteApartment($id): bool|null
    {
        $apartment = $this->apartmentRepository->findApartmentById($id);

        if (!$apartment) {
            return null;
        }

        return $this->apartmentRepository->deleteApartment($apartment);
    }
}
