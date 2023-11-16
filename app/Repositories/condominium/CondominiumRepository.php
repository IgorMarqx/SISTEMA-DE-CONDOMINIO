<?php

namespace App\Repositories\condominium;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
            'color' => $data['color'],
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
        DB::transaction(function () use ($condominium) {
            $condominium->load('area');

            $condominium->area->each(function ($area) {
                $area->delete();
            });

            $condominium->delete();
        });

        return true;
    }

    public function filterCondominium($data): LengthAwarePaginator
    {
        return Condominium::where('id', 'like', "%$data->condominiumFilter%")
            ->orWhere('name', 'like', "%$data->condominiumFilter%")
            ->orWhere('address', 'like', "%$data->condominiumFilter%")
            ->paginate(10);
    }
}
