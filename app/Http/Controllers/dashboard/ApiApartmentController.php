<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\apartments\ApartmentCreateRequest;
use App\Http\Requests\apartments\ApartmentUpdateRequest;
use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\ApiResource;
use App\Services\apartment\ApartmentService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ApiApartmentController extends Controller
{
    private ApartmentService $apartmentService;

    public function __construct(ApartmentService $apartmentService)
    {
        $this->apartmentService = $apartmentService;
    }

    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index(): Collection
    {
        try {
            return $this->apartmentService->getAll();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar apartamentos:' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(ApartmentCreateRequest $request): ApiResource
    {
        $this->apartmentService->storeApartment($request);

        try {
            return new ApiResource(['error' => false, 'message' => 'Apartamento criado com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(string $id): ApiResource|ApartmentShowResource
    {
        $apartment = $this->apartmentService->findApartmentById($id);

        if (!$apartment) {
            return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 422);
        }

        try {
            return new ApartmentShowResource($apartment);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(ApartmentUpdateRequest $request, string $id): ApiResource
    {
        $apartment = $this->apartmentService->updateApartment($request, $id);

        if (!$apartment) {
            return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 404);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Apartamento atualizado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(string $id): ApiResource
    {
        $apartment = $this->apartmentService->deleteApartment($id);

        if (!$apartment) {
            return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 422);
        }

        try {
            return new ApiResource(['error' => false, 'message' => 'Apartamento deletado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }

    }
}
