<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\areas\AreaErrorResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Http\Resources\areas\AreaUpdateResource;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

interface AreaRepositoryInterface
{
    public function getAll(): Collection;
    public function storeArea($data): Area;
    public function findAreaById($id): AreaErrorResource|AreaShowResource;
    public function updateArea($data, $id): AreaUpdateResource|AreaErrorResource;
    public function deleteArea($id): object;
}
