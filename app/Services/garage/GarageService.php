<?php

namespace App\Services\garage;

use App\Http\Requests\garage\GarageRequest;
use App\Models\Garage;
use App\Repositories\Interfaces\GarageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GarageService
{
    private GarageRepositoryInterface $garageRepository;

    public function __construct(GarageRepositoryInterface $garageRepository)
    {
        $this->garageRepository = $garageRepository;
    }

    /**
     * @throws Exception
     */
    public function storeGarage($request): Garage
    {
        return $this->garageRepository->storeGarage($request);
    }

    /**
     * @throws Exception
     */
    public function findGarageById(string $id): null|Collection|Garage
    {
        return $this->garageRepository->findGarageById($id);
    }

    /**
     * @throws Exception
     */
    public function updateGarage(string $id, GarageRequest $data): Garage|null|bool
    {
        $garage = $this->garageRepository->findGarageById($id);

        if (!$garage) {
            return null;
        }

        return $this->garageRepository->updateGarage($garage, [
            'identify' => $data->identify,
            'apartment_id' => $data->apartment_id,
        ]);
    }

    /**
     * @throws Exception
     */
    public function deleteGarage(string $id): Garage|bool|null
    {
        $garage = $this->garageRepository->findGarageById($id);

        if(!$garage){
            return null;
        }

        return $this->garageRepository->deleteGarage($garage);
    }
}
