<?php

namespace App\Http\Resources\apartments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'error' => '',
          'message' => 'Área atualizada com sucesso'
        ];
    }
}
