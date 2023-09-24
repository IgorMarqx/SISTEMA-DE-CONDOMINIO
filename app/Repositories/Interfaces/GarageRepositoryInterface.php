<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\garage\GarageShowResource;

interface GarageRepositoryInterface
{
    public function storeGarage($data): ApiResource;
    public function findGarageById($id): ApiResource|GarageShowResource;
    public function updateGarage($id, $data): ApiResource;
    public function deleteGarage($id): ApiResource;
}
