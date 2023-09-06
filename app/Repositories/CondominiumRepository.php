<?php

namespace App\Repositories;

use App\Models\Condominium;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;

class CondominiumRepository implements CondominiumRepositoryInterface
{
    public function getAll(): object
    {
        $condominium = Condominium::all();

        return response()->json($condominium);
    }

    public function storeCondominium(): void
    {
    }

    public function findCondominiumById()
    {
    }

    public function updateCondominium(): void
    {
    }

    public function deleteCondominium(): void
    {
    }
}
