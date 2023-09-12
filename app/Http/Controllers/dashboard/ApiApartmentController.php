<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\apartments\ApartmentCreateRequest;
use App\Http\Resources\apartments\ApartmentErroResource;
use App\Http\Resources\apartments\ApartmentResource;
use App\Http\Resources\apartments\ApartmentShowResource;
use App\Repositories\ApartmentRepository;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Collection;

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
    public function store(ApartmentCreateRequest $request): ApartmentResource
    {
        $apartment = $this->apartmentRepository->storeApartment($request);

        return new ApartmentResource($apartment);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(string $id): ApartmentErroResource|ApartmentShowResource
    {
        return $this->apartmentRepository->findApartmentById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
