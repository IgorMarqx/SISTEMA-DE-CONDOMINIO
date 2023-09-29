<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\areas\AreaCreateRequest;
use App\Http\Requests\areas\AreaUpdateRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Services\area\AreaService;
use Exception;
use \Illuminate\Database\Eloquent\Collection;

class ApiAreaController extends Controller
{
    private AreaService $areaService;

    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            return $this->areaService->getAll();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar apartamentos:' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(AreaCreateRequest $request): ApiResource
    {
        $this->areaService->storeArea($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Área criada com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Falha ao criar area:' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @throws Exception
     */
    public function show(string $id): ApiResource|AreaShowResource
    {
        $area = $this->areaService->findAreaById($id);

        if (!$area) {
            return new ApiResource(['error' => true, 'message' => 'Área não encontrada'], 404);
        }
        try {
            return new AreaShowResource($area);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar área:' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @throws Exception
     */
    public function update(AreaUpdateRequest $request, string $id): ApiResource
    {
        $area = $this->areaService->updateArea($request, $id);

        if (!$area) {
            return new ApiResource(['error' => true, 'message' => 'Área não encontrada'], 404);
        }
        try {
            return new ApiResource(['error' => false, 'message' => 'Área atualizada com sucesso'], 200);
        } catch
        (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @throws Exception
     */
    public function destroy(string $id): ApiResource
    {
        $area = $this->areaService->deleteArea($id);

        if (!$area) {
            return new ApiResource(['error' => true, 'message' => 'Área não encontrada.'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Área deletada com sucesso.'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }
}
