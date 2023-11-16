<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\condominiums\CondominiumRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\condominiums\CondominiumShowResource;
use App\Services\condominium\CondominiumService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ApiCondominiumController extends Controller
{
    private CondominiumService $condominiumService;

    public function __construct(CondominiumService $condominiumService)
    {
        $this->condominiumService = $condominiumService;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            return $this->condominiumService->getAll();
        } catch (Exception $e) {
            throw new Exception('Error: '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(CondominiumRequest $request): object
    {
        $this->condominiumService->storeCondominium($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Condominio criado com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @throws Exception
     */
    public function show(string $id): ApiResource|CondominiumShowResource
    {
        $condominium = $this->condominiumService->findCondominiumById($id);

        if (! $condominium) {
            return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        }

        try {
            return new CondominiumShowResource($condominium);
        } catch (Exception $e) {
            throw new Exception('Erro ao encontrar condominio:'.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update(CondominiumRequest $request, string $id): ApiResource
    {
        $condominium = $this->condominiumService->updateCondominium($request, $id);

        if (! $condominium) {
            return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Condominio atualizado com sucesso.'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Exception
     */
    public function destroy(string $id): ApiResource
    {
        $condominium = $this->condominiumService->deleteCondominium($id);

        if (! $condominium) {
            return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Condominio deletado com sucesso.'], 200);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:'.$e->getMessage());
        }
    }
}
