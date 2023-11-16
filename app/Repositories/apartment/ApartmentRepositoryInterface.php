<?php

namespace App\Repositories\apartment;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Collection;

interface ApartmentRepositoryInterface
{
    public function getAll(): Collection;

    public function storeApartment($data): ?Apartment;

    public function findApartmentById($id): Collection|Apartment|null;

    public function updateApartment(Apartment $apartment, $data): ?bool;

    public function deleteApartment(Apartment $apartment): ?bool;
}
