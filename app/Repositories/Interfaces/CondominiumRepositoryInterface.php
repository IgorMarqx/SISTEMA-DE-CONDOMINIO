<?php

namespace App\Repositories\Interfaces;

interface CondominiumRepositoryInterface
{
    public function getAll(): object;
    public function storeCondominium($data): void;
    public function findCondominiumById($id): object;
    public function updateCondominium(): void;
    public function deleteCondominium(): void;
}
