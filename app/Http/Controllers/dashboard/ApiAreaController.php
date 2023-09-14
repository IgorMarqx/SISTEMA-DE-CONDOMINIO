<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\areas\AreaCreateRequest;
use App\Http\Requests\areas\AreaUpdateRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use \Illuminate\Database\Eloquent\Collection;

class ApiAreaController extends Controller
{
    private AreaRepositoryInterface $areaRepository;

    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return $this->areaRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AreaCreateRequest $request): ApiResource
    {
        return $this->areaRepository->storeArea($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ApiResource|AreaShowResource
    {
        return $this->areaRepository->findAreaById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaUpdateRequest $request, string $id): ApiResource
    {
        return $this->areaRepository->updateArea($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): ApiResource
    {
        return $this->areaRepository->deleteArea($id);
    }
}
