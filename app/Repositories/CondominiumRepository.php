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

    public function storeCondominium($data): void
    {
        $condominium = Condominium::create([
            'name' => $data['name'],
            'address' => $data['address'],
        ]);
        $condominium->save();
    }

    public function findCondominiumById($id): object
    {
        $condominium = Condominium::find($id);

        if(!$condominium){
            return response()->json(['error' => true, 'message' => 'Condominio não encontrado.']);
        }

        return $condominium;
    }

    public function updateCondominium(): void
    {
    }

    public function deleteCondominium(): void
    {
    }
}
