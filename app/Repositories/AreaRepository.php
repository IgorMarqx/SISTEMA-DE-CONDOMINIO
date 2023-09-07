<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;

class AreaRepository implements AreaRepositoryInterface
{
    public function getAll(): object
    {
        $area = Area::all();

        return $area;
    }

    public function storeArea($data): object
    {
        $area = Area::create([

        ]);
    }
}
