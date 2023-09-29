<?php

namespace App\Repositories\Interfaces;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Collection;

interface ApartmentRepositoryInterface
{
    public function getAll(): Collection;

    public function storeApartment($data): Apartment|null;

    public function findApartmentById($id): Collection|Apartment|null;

    public function updateApartment(Apartment $apartment, $data): bool|null;

    public function deleteApartment(Apartment $apartment): bool|null;
}
