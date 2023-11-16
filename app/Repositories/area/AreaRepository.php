<?php

namespace App\Repositories\area;

use App\Models\Area;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AreaRepository implements AreaRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        return Area::all();
    }

    /**
     * @throws Exception
     */
    public function storeArea($data): Area
    {
        return Area::create([
            'name' => $data['name'],
            'days' => $data['days'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'condominium_id' => $data['condominium_id'],
            'allowed' => 1,
        ]);
    }

    public function findAreaById($id): Area|Collection|null
    {
        return Area::with('condominium')->find($id);
    }

    /**
     * @throws Exception
     */
    public function updateArea(Area $area, $data): bool
    {
        return $area->update($data);
    }

    /**
     * @throws Exception
     */
    public function deleteArea(Area $area): bool
    {
        return $area->delete();
    }
}
