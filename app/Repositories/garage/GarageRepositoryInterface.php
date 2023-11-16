<?php

namespace App\Repositories\garage;

use App\Models\Garage;
use Illuminate\Database\Eloquent\Collection;

interface GarageRepositoryInterface
{
    public function storeGarage($data): Garage;

    public function findGarageById($id): Garage|null|Collection;

    public function updateGarage(Garage $garage, $data): Garage|bool|null;

    public function deleteGarage(Garage $garage): Garage|bool|null;
}
