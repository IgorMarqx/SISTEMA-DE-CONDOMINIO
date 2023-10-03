<?php

namespace App\Services\condominium;

use App\Models\Condominium;
use App\Repositories\condominium\CondominiumRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CondominiumService
{
    private CondominiumRepositoryInterface $condominiumRepository;

    public function __construct(CondominiumRepositoryInterface $condominiumRepository)
    {
        $this->condominiumRepository = $condominiumRepository;
    }

    public function getAll(): Collection
    {
        return $this->condominiumRepository->getAll();
    }

    public function storeCondominium($data): Condominium
    {
        return $this->condominiumRepository->storeCondominium($data);
    }

    public function findCondominiumById($id): bool|Condominium|null
    {
        return $this->condominiumRepository->findCondominiumById($id);
    }

    public function updateCondominium($data, $id): bool|Condominium|null
    {
        $condominium = $this->condominiumRepository->findCondominiumById($id);

        if (!$condominium) {
            return null;
        }

        return $this->condominiumRepository->updateCondominium($condominium, [
            'name' => $data->name,
            'address' => $data->address,
            'color' => $data->color
        ]);
    }

    public function deleteCondominium($id): bool|null
    {
        $condominium = $this->condominiumRepository->findCondominiumById($id);

        if (!$condominium) {
            return null;
        }

        return $this->condominiumRepository->deleteCondominium($condominium);
    }

    public function filterCondominium($data): LengthAwarePaginator|null
    {
        $filter = $this->condominiumRepository->filterCondominium($data);

        if($filter->isEmpty()){
            return null;
        }

        return $filter;
    }
}
