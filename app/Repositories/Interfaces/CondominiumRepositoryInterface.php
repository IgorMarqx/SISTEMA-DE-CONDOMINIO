<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\condominiums\CondominiumShowResource;
use App\Models\Condominium;
use Illuminate\Database\Eloquent\Collection;

interface CondominiumRepositoryInterface
{
    public function getAll(): Collection;

    public function storeCondominium($data): Condominium;

    public function findCondominiumById($id): Condominium|Collection|null;

    public function updateCondominium(Condominium $condominium, $data): Condominium|null|bool;

    public function deleteCondominium(Condominium $condominium): bool;
}
