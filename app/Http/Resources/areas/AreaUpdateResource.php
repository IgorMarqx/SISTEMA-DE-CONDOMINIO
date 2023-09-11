<?php

namespace App\Http\Resources\areas;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaUpdateResource extends JsonResource
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
            'message' => 'Área atualizada com sucesso.'
        ];
    }
}
