<?php

namespace App\Repositories\Interfaces;

use App\Models\Garage;

interface GarageRepositoryInterface
{
    public function storeGarage($data): Garage;
    public function findGarageById($id): Garage;
    public function updateGarage($id, $data): Garage;
    public function deleteGarage($id): Garage;
}
