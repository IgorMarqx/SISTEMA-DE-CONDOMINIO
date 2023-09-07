<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondominiumRequest;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Illuminate\Http\Request;

class ApiCondominiumController extends Controller
{
    private $condominiumRepository;

    public function __construct(CondominiumRepositoryInterface $condominiumRepository)
    {
        $this->condominiumRepository = $condominiumRepository;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        return $this->condominiumRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CondominiumRequest $request)
    {
        return $this->condominiumRepository->storeCondominium($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        return $this->condominiumRepository->findCondominiumById($id);
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit(string $id): object
    {
        return $this->condominiumRepository->findCondominiumById($id);
    }

    public function update(CondominiumRequest $request, string $id): object
    {
        return $this->condominiumRepository->updateCondominium($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        return $this->condominiumRepository->deleteCondominium($id);
    }
}
