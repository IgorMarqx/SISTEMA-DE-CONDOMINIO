<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\garage\GarageRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\garage\GarageShowResource;
use App\Services\garage\GarageService;
use Exception;

class ApiGarageController extends Controller
{
    private GarageService $garageService;

    public function __construct(GarageService $garageService)
    {
        $this->garageService = $garageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @throws Exception
     */
    public function store(GarageRequest $request): ApiResource
    {
        $this->garageService->storeGarage($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem cadastrada com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro: '.$e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function show(string $id): GarageShowResource|ApiResource
    {
        $garage = $this->garageService->findGarageById($id);

        if (! $garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        try {
            return new GarageShowResource($garage);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar garagem:'.$e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update(GarageRequest $request, string $id): ApiResource
    {
        $garage = $this->garageService->updateGarage($id, $request);

        if (! $garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem atualizada com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:'.$e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id): ApiResource
    {
        $garage = $this->garageService->deleteGarage($id);

        if (! $garage) {
            return new ApiResource(['error' => true, 'message' => 'Garagem não encontrada'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Garagem deletada com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar garagem:'.$e->getMessage());
        }
    }
}
