<?php

namespace App\Http\Resources\condominiums;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CondominiumShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
            'areas' => $this->area
        ];
    }
}
