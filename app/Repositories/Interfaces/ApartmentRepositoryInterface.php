<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\ApiResource;

interface ApartmentRepositoryInterface
{
    public function getAll();

    public function storeApartment($data): ApiResource;

    public function findApartmentById($id): ApiResource|ApartmentShowResource;

    public function updateApartment($data, $id): ApiResource;

    public function deleteApartment($id): ApiResource;
}
