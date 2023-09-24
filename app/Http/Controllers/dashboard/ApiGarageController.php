<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\garage\GarageRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\garage\GarageShowResource;
use App\Repositories\GarageRepository;
use Illuminate\Http\Request;

class ApiGarageController extends Controller
{
    private GarageRepository $garageRepository;

    public function __construct(GarageRepository $garageRepository)
    {
        $this->garageRepository = $garageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(GarageRequest $request): ApiResource
    {
        return $this->garageRepository->storeGarage($request);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(string $id): ApiResource|GarageShowResource
    {
        return $this->garageRepository->findGarageById($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(GarageRequest $request, string $id): ApiResource
    {
        return $this->garageRepository->updateGarage($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(string $id): ApiResource
    {
        return $this->garageRepository->deleteGarage($id);
    }
}
