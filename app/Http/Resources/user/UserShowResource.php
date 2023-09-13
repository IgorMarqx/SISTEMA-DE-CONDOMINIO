<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
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
            'email' => $this->email,
            'condominium_id' => $this->condominium_id,
            'apartment_id' => $this->apartment_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'date_now' => date('Y-m-d H:i:s')
        ];
    }
}
