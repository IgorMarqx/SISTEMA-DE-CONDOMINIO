<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\apartments\ApartmentCreateRequest;
use App\Http\Requests\apartments\ApartmentUpdateRequest;
use App\Http\Resources\ApiResource;
use App\Repositories\ApartmentRepository;
use Illuminate\Http\Request;

class ApiApartmentController extends Controller
{
    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index(): object
    {
        return $this->apartmentRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(ApartmentCreateRequest $request): ApiResource
    {
        return $this->apartmentRepository->storeApartment($request);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(string $id): ApiResource
    {
        return $this->apartmentRepository->findApartmentById($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(ApartmentUpdateRequest $request, string $id): ApiResource
    {
        return $this->apartmentRepository->updateApartment($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(string $id): ApiResource
    {
        return $this->apartmentRepository->deleteApartment($id);
    }
}
