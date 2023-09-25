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
        return $this->garageService->storeGarage($request);
    }

    /**
     * @throws Exception
     */
    public function show(string $id): GarageShowResource|ApiResource
    {
        return $this->garageService->findGarageById($id);
    }

    /**
     * @throws Exception
     */
    public function update(GarageRequest $request, string $id): ApiResource
    {
        return $this->garageService->updateGarage($id, $request);
    }

    /**
     * @throws Exception
     */
    public function destroy(string $id): ApiResource
    {
        return $this->garageService->deleteGarage($id);
    }
}
