<?php

namespace App\Repositories;

use App\Http\Resources\apartments\ApartmentErroResource;
use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\apartments\ApartmentUpdateResource;
use App\Models\Apartment;
use App\Repositories\Interfaces\ApartmentRepositoryInterface;
use Exception;
use \Illuminate\Database\Eloquent\Collection;

class ApartmentRepository implements ApartmentRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        try {
            return Apartment::all();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar apartamentos:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function storeApartment($data): apartment
    {
        $apartment = Apartment::create([
            'identify' => $data['identify'],
            'condominium_id' => $data['condominium_id'],
            'garage_id' => $data['garage_id'],
        ]);

        try {
            return $apartment;
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findApartmentById($id): ApartmentErroResource|ApartmentShowResource
    {
        $apartment = Apartment::with('garage')->find($id);

        if (!$apartment) {
            return new ApartmentErroResource('Apartamento não encontrado');
        }

        try {
            return new ApartmentShowResource($apartment);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }

    public function updateApartment($data, $id): ApartmentErroResource|ApartmentUpdateResource
    {
        $apartment = Apartment::find($id);

        if ($apartment) {
            $apartment->update([
                'identify' => $data->identify,
                'condominium_id' => $data->condominium_id,
            ]);

            return new ApartmentUpdateResource($apartment);
        }

        return new ApartmentErroResource('Apartamento não encontrado');
    }

    public function deleteApartment($id)
    {
        // TODO: Implement deleteApartment() method.
    }
}
