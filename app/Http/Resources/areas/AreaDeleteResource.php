<?php

namespace App\Http\Resources\areas;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaDeleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $message;

    public function __construct($message)
    {
        parent::__construct($message);
        return $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => '',
            'message' => $this->message
        ];
    }
}
