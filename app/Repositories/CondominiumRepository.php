<?php

namespace App\Repositories;

use App\Models\Condominium;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;

class CondominiumRepository implements CondominiumRepositoryInterface
{
    public function getAll(): object
    {
        return Condominium::all();
    }

    public function storeCondominium($data): object
    {
        $condominium = Condominium::create([
            'name' => $data['name'],
            'address' => $data['address'],
        ]);
        $condominium->save();

        return response()->json(['error' => '', 'message' => 'Condominio cadastrado com sucesso.'], 201);
    }

    public function findCondominiumById($id): object
    {
        $condominium = Condominium::find($id);

        if (!$condominium) {
            return response()->json(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        }

        return $condominium;
    }

    public function updateCondominium($data, $id): object
    {
        $condominium = Condominium::find($id);

        if ($condominium) {
            $condominium->name = $data['name'];
            $condominium->address = $data['address'];
            $condominium->save();

            return response()->json(['error' => '', 'message' => 'Condominio atualizado com sucesso.'], 201);
        }

        return response()->json(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
    }

    public function deleteCondominium($id): object
    {
        $condominium = Condominium::find($id);

        if ($condominium) {
            $condominium->delete();
        }

        return response()->json(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
    }
}
