<?php

namespace App\Repositories;

use App\Http\Resources\ApiResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AreaRepository implements AreaRepositoryInterface
{
    /**
     * @throws Exception
     */
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
    public function storeArea($data): ApiResource
    {
        Area::create([
            'name' => $data['name'],
            'days' => $data['days'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'condominium_id' => $data['condominium_id'],
            'allowed' => 1
        ]);

        try {
            return new ApiResource(false, 'Área criada com sucesso');
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findAreaById($id): ApiResource|AreaShowResource
    {
        $area = Area::with('condominium')->find($id);

        if (!$area) {
            return new ApiResource(true, 'Área não encontrada');
        }

        try {
            return new AreaShowResource($area);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateArea($data, $id): ApiResource
    {
        $area = Area::find($id);

        try {
            if ($area) {
                $area->update([
                    'allowed' => $data['allowed'],
                    'name' => $data['name'],
                    'days' => $data['days'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'condominium_id' => $id
                ]);

                return new ApiResource(false, 'Área atualizada com sucesso');
            }

            return new ApiResource(true, 'Área não encontrada');
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function deleteArea($id): ApiResource
    {
        $area = Area::find($id);


        try {
            if (!$area) {
                return new ApiResource(true, 'Área não encontrada.');
            }

            $area->delete($id);
            return new ApiResource(false, 'Área deletada com sucesso.');
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }
}
