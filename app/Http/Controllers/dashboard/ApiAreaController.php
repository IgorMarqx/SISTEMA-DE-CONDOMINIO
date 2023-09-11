<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\areas\AreaCreateRequest;
use App\Http\Requests\areas\AreaUpdateRequest;
use App\Http\Resources\areas\AreaResource;
use App\Http\Resources\areas\AreaUpdateResource;
use App\Repositories\Interfaces\AreaRepositoryInterface;

class ApiAreaController extends Controller
{
    private $areaRepository;

    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        return $this->areaRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AreaCreateRequest $request): AreaResource
    {
        $area = $this->areaRepository->storeArea($request);

        return new AreaResource($area);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        return $this->areaRepository->findAreaById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaUpdateRequest $request, string $id): AreaUpdateResource
    {
        $area = $this->areaRepository->updateArea($request, $id);

        return new AreaUpdateResource($area);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        return $this->areaRepository->deleteArea($id);
    }
}
