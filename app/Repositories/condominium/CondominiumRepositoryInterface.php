<?php

namespace App\Repositories\condominium;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CondominiumRepositoryInterface
{
    public function getAll(): Collection;

    public function storeCondominium($data): Condominium;

    public function findCondominiumById($id): Condominium|Collection|null;

    public function updateCondominium(Condominium $condominium, $data): Condominium|null|bool;

    public function deleteCondominium(Condominium $condominium): bool;

    public function filterCondominium($data): LengthAwarePaginator;
}
