<?php

namespace App\Services\area;

use App\Models\Area;
use App\Repositories\area\AreaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AreaService
{
    private AreaRepositoryInterface $areaRepository;

    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAll(): Collection
    {
        return $this->areaRepository->getAll();
    }

    public function storeArea($data): Area
    {
        return $this->areaRepository->storeArea($data);
    }

    public function findAreaById($id): Collection|Area|null
    {
        return $this->areaRepository->findAreaById($id);
    }

    public function updateArea($data, $id): bool
    {
        $area = $this->areaRepository->findAreaById($id);

        if (! $area) {
            return false;
        }

        return $this->areaRepository->updateArea($area, [
            'name' => $data->name,
            'days' => $data->days,
            'start_time' => $data->start_time,
            'end_time' => $data->end_time,
            'condominium_id' => $data->condominium_id,
            'allowed' => $data->allowed,
        ]);
    }

    public function deleteArea($id): ?bool
    {
        $area = $this->areaRepository->findAreaById($id);

        if (! $area) {
            return null;
        }

        return $this->areaRepository->deleteArea($area);
    }
}
