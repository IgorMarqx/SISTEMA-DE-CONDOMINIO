<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\condominiums\CondominiumShowResource;
use Illuminate\Database\Eloquent\Collection;

interface CondominiumRepositoryInterface
{
    public function getAll(): Collection;
    public function storeCondominium($data): ApiResource;
    public function findCondominiumById($id): CondominiumShowResource|ApiResource;
    public function updateCondominium($data, $id): ApiResource;
    public function deleteCondominium($id): ApiResource;
}
