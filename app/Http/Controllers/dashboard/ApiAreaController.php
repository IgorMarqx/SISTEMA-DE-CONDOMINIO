<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use Illuminate\Http\Request;

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
    public function store(AreaRequest $request): object
    {
        return $this->areaRepository->storeArea($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):object
    {
        return $this->areaRepository->findAreaById($id);
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
