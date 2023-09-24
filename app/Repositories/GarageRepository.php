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
    public function storeGarage($data): ApiResource
    {
        Garage::create([
            'identify' => $data['identify'],
            'apartment_id' => $data['apartment_id'],
        ]);
        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem cadastrada com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findGarageById($id): GarageShowResource|ApiResource
    {
        $garage = Garage::with('apartment')->find($id);

        if (!$garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        try {
            return new GarageShowResource($garage);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateGarage($id, $data): ApiResource
    {
        $garage = Garage::find($id);

        if (!$garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        $garage->update([
            'identify' => $data['identify'],
            'apartment_id' => $data['apartment_id'],
        ]);

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem atualizada com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function deleteGarage($id): ApiResource
    {
        $garage = Garage::find($id);

        if (!$garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        $garage->delete();

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem deletada com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar garagem:' . $e->getMessage());
        }
    }

}
