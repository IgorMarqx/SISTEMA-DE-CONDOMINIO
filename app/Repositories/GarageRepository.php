<?php

namespace App\Repositories;

use App\Http\Resources\ApiResource;
use App\Http\Resources\garage\GarageShowResource;
use App\Models\Garage;
use App\Repositories\Interfaces\GarageRepositoryInterface;
use Exception;

class GarageRepository implements GarageRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function storeGarage($data): Garage
    {
        return Garage::create([
            'identify' => $data['identify'],
            'apartment_id' => $data['apartment_id'],
        ]);
    }

    /**
     * @throws Exception
     */
    public function findGarageById($id): Garage
    {
        return Garage::with('apartment')->find($id);
    }

    /**
     * @throws Exception
     */
    public function updateGarage($id, $data): Garage
    {
        return Garage::find($id);
    }

    /**
     * @throws Exception
     */
    public function deleteGarage($id): Garage
    {
        return Garage::find($id);
    }

}
