<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\ApiResource;
use App\Http\Resources\areas\AreaErrorResource;
use App\Http\Resources\areas\AreaShowResource;
use App\Http\Resources\areas\AreaUpdateResource;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

interface AreaRepositoryInterface
{
    public function getAll(): Collection;
    public function storeArea($data): ApiResource;
    public function findAreaById($id): ApiResource|AreaShowResource;
    public function updateArea($data, $id): ApiResource;
    public function deleteArea($id): ApiResource;
}
