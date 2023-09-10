<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;

class AreaRepository implements AreaRepositoryInterface
{
    public function getAll(): object
    {
        return Area::all();
    }

    public function storeArea($data): object
    {
        $area = Area::create([
            'name' => $data['name'],
            'days' => $data['days'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'condominium_id' => $data['condominium_id'],
        ]);
        $area->save();

        return response()->json(['error' => '', 'message' => 'Área cadastrada com sucesso.'], 201);
    }

    public function findAreaById($id): object
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['error' => true, 'message' => 'Área não encontrada'], 404);
        }

        return $area;
    }

    public function updateArea($data, $id): object
    {
        $area = Area::find($id);

        if ($area) {
            $area->name = $data['name'];
            $area->condominium_id = $data['condominium_id'];
            $area->operations_id = $data['operations_id'];
            $area->save();

            return response()->json(['error' => '', 'message' => 'Área atualizada com sucesso.'], 201);
        }

        return response()->json(['error' => true, 'message' => 'Área não encontrada.'], 404);
    }

    public function deleteArea($id): object
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['error' => true, 'message' => 'Area não encontrada.'], 404);
        }

        $area->delete($id);
        return response()->json(['error' => '', 'message' => 'Área deletada com sucesso.']);
    }

}
