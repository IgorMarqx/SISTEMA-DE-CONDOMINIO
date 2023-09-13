<?php

namespace App\Repositories;

use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\ApiResource;
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
    public function storeApartment($data): ApiResource
    {
        Apartment::create([
            'identify' => $data['identify'],
            'condominium_id' => $data['condominium_id'],
            'garage_id' => $data['garage_id'],
        ]);

        try {
            return new ApiResource(false, 'Apartamento criado com sucesso');
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findApartmentById($id): ApiResource|ApartmentShowResource
    {
        $apartment = Apartment::with('garage')->find($id);

        if (!$apartment) {
            return new ApiResource(true, 'Apartamento não encontrado');
        }

        try {
            return new ApartmentShowResource($apartment);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateApartment($data, $id): ApiResource
    {
        $apartment = Apartment::find($id);

        try {
            if (!$apartment) {
                $apartment->update([
                    'identify' => $data->identify,
                    'condominium_id' => $data->condominium_id,
                ]);

                return new ApiResource(false, 'Apartamento atualizado com sucesso');
            }

            return new ApiResource(true, 'Apartamento não encontrado');
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function deleteApartment($id): ApiResource
    {
        $apartment = Apartment::find($id);

        try {
            if (!$apartment) {
                return new ApiResource(true, 'Apartamento não encontrado');
            }

            $apartment->delete();
            return new ApiResource(false, 'Apartamento deletado com sucesso');
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
