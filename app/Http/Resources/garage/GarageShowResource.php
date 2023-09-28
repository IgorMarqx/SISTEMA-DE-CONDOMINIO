<?php

namespace App\Http\Resources\garage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GarageShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identify' => $this->identify,
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
            'apartment' => $this->apartment,
        ];
    }
}
