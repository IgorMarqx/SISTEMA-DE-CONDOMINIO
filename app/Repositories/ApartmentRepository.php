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
            return new ApiResource(['error' => false, 'message' => 'Apartamento criado com sucesso'], 201);
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
            return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 422);
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

                return new ApiResource(['error' => false, 'message' => 'Apartamento atualizado com sucesso'], 200);
            }

            return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 422);
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
                return new ApiResource(['error' => true, 'message' => 'Apartamento não encontrado'], 422);
            }

            $apartment->delete();
            return new ApiResource(['error' => false, 'message' => 'Apartamento deletado com sucesso'], 200);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
