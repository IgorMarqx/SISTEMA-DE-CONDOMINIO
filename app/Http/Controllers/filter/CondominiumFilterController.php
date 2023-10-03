<?php

namespace App\Http\Controllers\filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\filters\condominium\CondominiumFilterRequest;
use App\Http\Resources\ApiResource;
use App\Services\condominium\CondominiumService;
use Illuminate\Pagination\LengthAwarePaginator;

class CondominiumFilterController extends Controller
{
    private $condominiumService;

    public function __construct(CondominiumService $condominiumService)
    {
        $this->condominiumService = $condominiumService;
    }

    public function filterCondominium(CondominiumFilterRequest $request): LengthAwarePaginator|ApiResource
    {
        $filter = $this->condominiumService->filterCondominium($request);

        if (!$filter) {
            return new ApiResource(['error' => true, 'message' => 'Nenhum condomínio encontrado'], 404);
        }

        return $filter;
    }
}
