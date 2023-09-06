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
        return $this->condominiumRepository = $condominiumRepository;
        $this->middleware('api.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        $condominiums = $this->condominiumRepository->getAll();

        return $condominiums;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CondominiumRequest $request)
    {
        $condominium = $this->condominiumRepository->storeCondominium($request);

        return $condominium;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        $condominium = $this->condominiumRepository->findCondominiumById($id);

        return $condominium;
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit(string $id): object
    {
        $condominium = $this->condominiumRepository->findCondominiumById($id);

        return $condominium;
    }

    public function update(CondominiumRequest $request, string $id): object
    {
        $condominium = $this->condominiumRepository->updateCondominium($request, $id);

        return $condominium;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        $condominium = $this->condominiumRepository->deleteCondominium($id);

        return $condominium;
    }
}
