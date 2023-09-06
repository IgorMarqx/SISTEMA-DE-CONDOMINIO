<?php

namespace App\Repositories\Interfaces;

interface CondominiumRepositoryInterface
{
    public function getAll(): object;
    public function storeCondominium(): void;
    public function findCondominiumById();
    public function updateCondominium(): void;
    public function deleteCondominium(): void;
}
