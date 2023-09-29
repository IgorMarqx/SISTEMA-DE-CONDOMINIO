<?php

namespace App\Repositories;

use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\ApiResource;
use App\Models\Apartment;
use App\Models\Garage;
use App\Repositories\Interfaces\ApartmentRepositoryInterface;
use Exception;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ApartmentRepository implements ApartmentRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        return Apartment::all();
    }

    /**
     * @throws Exception
     */
    public function storeApartment($data): Apartment|null
    {
        return Apartment::create([
            'identify' => $data['identify'],
            'condominium_id' => $data['condominium_id'],
            'garage_id' => $data['garage_id'],
        ]);
    }

    /**
     * @throws Exception
     */
    public function findApartmentById($id): Collection|Apartment|null
    {
        return Apartment::with('garage')->find($id);
    }

    /**
     * @throws Exception
     */
    public function updateApartment(Apartment $apartment, $data): bool|null
    {
        return $apartment->update();
    }

    /**
     * @throws Exception
     */
    public function deleteApartment(Apartment $apartment): bool|null
    {
        DB::transaction(function () use ($apartment) {
            $apartment->load('garage');

            $apartment->garage->each(function ($garage) {
                $garage->delete();
            });

            $apartment->delete();
        });
        return true;
    }
}
