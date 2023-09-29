<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Models\Area;
use App\Models\Condominium;
use Illuminate\Database\Eloquent\Collection;

interface AreaRepositoryInterface
{
    public function getAll(): Collection;

    public function storeArea($data): Area;

    public function findAreaById($id): Area|Collection|null;

    public function updateArea(Area $area, $data): bool;

    public function deleteArea(Area $area): bool;
}
