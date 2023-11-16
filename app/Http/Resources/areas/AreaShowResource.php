<?php

namespace App\Http\Resources\areas;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaShowResource extends JsonResource
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
            'allowed' => $this->allowed,
            'name' => $this->name,
            'days' => $this->days,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'condominium_id' => $this->condominium_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
            'condominium' => $this->condominium,
        ];
    }
}
