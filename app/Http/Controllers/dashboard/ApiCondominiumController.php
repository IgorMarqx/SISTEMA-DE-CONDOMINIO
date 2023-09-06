<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Illuminate\Http\Request;

class ApiCondominiumController extends Controller
{
    private $condominiumRepository;

    public function __construct(CondominiumRepositoryInterface $condominiumRepository)
    {
        return $this->condominiumRepository = $condominiumRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        $condominiums = $this->condominiumRepository->getAll();

        return response()->json($condominiums);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
