<?php

namespace App\Repositories\Interfaces;

interface CondominiumRepositoryInterface
{
    public function getAll(): object;
    public function storeCondominium($data): object;
    public function findCondominiumById($id): object;
    public function updateCondominium($data, $id): object;
    public function deleteCondominium($id): object;
}
