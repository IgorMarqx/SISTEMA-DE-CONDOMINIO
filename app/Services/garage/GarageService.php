<?php

namespace App\Services\garage;

use App\Http\Requests\garage\GarageRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\garage\GarageShowResource;
use App\Models\Garage;
use App\Repositories\Interfaces\GarageRepositoryInterface;
use Exception;

class GarageService
{
    private GarageRepositoryInterface $garageRepository;

    public function __construct(GarageRepositoryInterface $garageRepository)
    {
        $this->garageRepository = $garageRepository;
    }

    /**
     * @throws Exception
     */
    public function storeGarage(GarageRequest $request): ApiResource
    {
        $this->garageRepository->storeGarage($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem cadastrada com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findGarageById(string $id): ApiResource|GarageShowResource
    {
        $garage = $this->garageRepository->findGarageById($id);

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
    public function updateGarage(string $id, GarageRequest $data): ApiResource
    {
        $garage = $this->garageRepository->updateGarage($id, $data);

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
    public function deleteGarage(string $id): ApiResource
    {
        $garage = $this->garageRepository->deleteGarage($id);

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
