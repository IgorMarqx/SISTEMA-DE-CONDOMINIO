<?php

namespace App\Repositories;

use App\Http\Resources\apartments\ApartmentShowResource;
use App\Http\Resources\ApiResource;
use App\Http\Resources\condominiums\CondominiumShowResource;
use App\Models\Area;
use App\Models\Condominium;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CondominiumRepository implements CondominiumRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        try {
            return Condominium::all();
        } catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function storeCondominium($data): ApiResource
    {
        Condominium::create([
            'name' => $data['name'],
            'address' => $data['address'],
        ]);

        try {
            return new ApiResource(['error' => false, 'message' => 'Condominio criado com sucesso'], 201);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar apartamento:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function findCondominiumById($id): CondominiumShowResource|ApiResource
    {
        $condominium = Condominium::with('area')->find($id);

        try {
            if (!$condominium) {
                return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
            }

            return new CondominiumShowResource($condominium);
        } catch (Exception $e) {
            throw new Exception('Erro ao encontrar condominio:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateCondominium($data, $id): ApiResource
    {
        $condominium = Condominium::find($id);

        try {
            if ($condominium) {
                $condominium->name = $data['name'];
                $condominium->address = $data['address'];
                $condominium->save();

                return new ApiResource(['error' => '', 'message' => 'Condominio atualizado com sucesso.'], 200);
            }

            return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function deleteCondominium($id): ApiResource
    {
        $condominium = Condominium::find($id);
        $area = Area::where('condominium_id', $id);

        try {
            if ($condominium) {
                $condominium->delete();
                $area->delete();
                return new ApiResource(['error' => '', 'message' => 'Condominio deletado com sucesso.'], 200);
            }

            return new ApiResource(['error' => true, 'message' => 'Condominio não encontrado.'], 404);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar/encontrar condominio:' . $e->getMessage());
        }
    }
}
