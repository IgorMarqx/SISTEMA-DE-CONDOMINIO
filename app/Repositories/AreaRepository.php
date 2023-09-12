<?php

namespace App\Repositories;

use App\Http\Resources\areas\AreaDeleteResource;
use App\Http\Resources\areas\AreaErrorResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Http\Resources\areas\AreaUpdateResource;
use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AreaRepository implements AreaRepositoryInterface
{
    public function getAll(): Collection
    {
        try {
            return Area::all();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar apartamentos:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function storeArea($data): Area
    {
        $area = Area::create([
            'name' => $data['name'],
            'days' => $data['days'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'condominium_id' => $data['condominium_id'],
            'allowed' => 1
        ]);

        return $area;
    }

    public function findAreaById($id): AreaErrorResource|AreaShowResource
    {
        $area = Area::with('condominium')->find($id);

        if (!$area) {
            return new AreaErrorResource('Área não encontrada');
        }

        return new AreaShowResource($area);
    }

    public function updateArea($data, $id): AreaErrorResource|AreaUpdateResource
    {
        $area = Area::find($id);

        if ($area) {
            $area->update([
                'allowed' => $data['allowed'],
                'name' => $data['name'],
                'days' => $data['days'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'condominium_id' => $id
            ]);

            return new AreaUpdateResource($area);
        }

        return new AreaErrorResource('Área não encontrada');
    }

    public function deleteArea($id): AreaDeleteResource|AreaErrorResource
    {
        $area = Area::find($id);

        if (!$area) {
            return new AreaErrorResource('Área não encontrada.');
        }

        $area->delete($id);
        return new AreaDeleteResource('Área deletada com sucesso.');
    }
}
