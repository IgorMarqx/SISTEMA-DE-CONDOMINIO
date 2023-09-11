<?php

namespace App\Repositories;

use App\Http\Resources\areas\AreaDeleteResource;
use App\Http\Resources\areas\AreaResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Http\Resources\areas\AreaUpdateResource;
use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class AreaRepository implements AreaRepositoryInterface
{
    public function getAll(): object
    {
        return Area::all();
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

    public function findAreaById($id): object
    {
        $area = Area::with('condominium')->find($id);

        if (!$area) {
            return response()->json(['error' => true, 'message' => 'Área não encontrada'], 404);
        }

        return new AreaShowResource($area);
    }

    public function updateArea($data, $id): object
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

            return $area;
        }

        return response()->json(['error' => true, 'message' => 'Área não encontrada.'], 404);
    }

    public function deleteArea($id): JsonResponse
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['error' => true, 'message' => 'Area não encontrada.'], 404);
        }

        $area->delete($id);
        return response()->json(['error' => '', 'message' => 'Área deletada com sucesso.']);
    }

}
