<?php

namespace App\Repositories\Interfaces;

use App\Models\Area;

interface AreaRepositoryInterface
{
    public function getAll(): object;
    public function storeArea($data): Area;
    public function findAreaById($id): object;
    public function updateArea($data, $id): object;
    public function deleteArea($id): object;
}
