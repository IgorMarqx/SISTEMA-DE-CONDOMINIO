<?php

namespace App\Repositories;

use App\Models\Area;
use App\Models\Condominium;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CondominiumRepository implements CondominiumRepositoryInterface
{

    public function getAll(): Collection
    {
        return Condominium::all();
    }

    public function storeCondominium($data): Condominium
    {
        return Condominium::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'color' => $data['color']
        ]);
    }

    public function findCondominiumById($id): Condominium|Collection|null
    {
        return Condominium::with('area')->find($id);
    }


    public function updateCondominium(Condominium $condominium, $data): Condominium|null|bool
    {
        return $condominium->update($data);
    }

    public function deleteCondominium(Condominium $condominium): bool
    {
        $area = Area::where('condominium_id', $condominium->id);
        $condominium->delete();
        $area->delete();

        return true;
    }
}
