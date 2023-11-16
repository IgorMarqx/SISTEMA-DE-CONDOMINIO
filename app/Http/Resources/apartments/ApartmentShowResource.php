<?php

namespace App\Http\Resources\apartments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identify' => $this->identify,
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
            'condominium_id' => $this->condominium_id,
            'garage' => $this->garage,
        ];
    }
}
