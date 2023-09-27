<?php

namespace App\Repositories;

use App\Models\Garage;
use App\Repositories\Interfaces\GarageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GarageRepository implements GarageRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function storeGarage($data): Garage
    {
        return Garage::create([
            'identify' => 'GARAGE '. $data['identify'],
            'apartment_id' => $data['apartment_id'],
        ]);
    }

    /**
     * @throws Exception
     */
    public function findGarageById($id): Garage|null|Collection
    {
        return Garage::with('apartment')->find($id);
    }

    /**
     * @throws Exception
     */
    public function updateGarage(Garage $garage, $data): Garage|bool|null
    {
        return $garage->update($data);
    }

    /**
     * @throws Exception
     */
    public function deleteGarage(Garage $garage): Garage|bool|null
    {
        return $garage->delete();
    }

}
