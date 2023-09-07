<?php

namespace App\Repositories\Interfaces;

interface AreaRepositoryInterface
{
    public function getAll(): object;
    public function storeArea($data): object;
    public function findAreaById($id): object;
    public function updateArea($data, $id): object;
    public function deleteArea($id): object;
}
