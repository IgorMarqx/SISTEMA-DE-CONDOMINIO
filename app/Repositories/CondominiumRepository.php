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

    public function storeCondominium($data): object
    {
        $condominium = Condominium::create([
            'name' => $data['name'],
            'address' => $data['address'],
        ]);
        $condominium->save();

        if ($condominium) {
            return response()->json(['error' => '', 'message' => 'Condominio cadastrado com sucesso.']);
        }

        return response()->json(['error' => true]);
    }

    public function findCondominiumById($id): object
    {
        $condominium = Condominium::find($id);

        if (!$condominium) {
            return response()->json(['error' => true, 'message' => 'Condominio não encontrado.']);
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

            return response()->json(['error' => '', 'message' => 'Condominio atualizado com sucesso.']);
        }

        return response()->json(['error' => true, 'message' => 'Condominio não encontrado.']);
    }

    public function deleteCondominium($id): object
    {
        $condominium = Condominium::find($id);

        if ($condominium) {
            $condominium->delete();
        }

        return response()->json(['error' => true, 'message' => 'Condominio não encontrado.']);
    }
}
