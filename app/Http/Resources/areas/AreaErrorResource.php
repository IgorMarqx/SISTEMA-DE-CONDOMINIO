<?php

namespace App\Http\Resources\areas;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        parent::__construct(null);
        return $this->errorMessage = $errorMessage;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => true,
            'message' => $this->errorMessage
        ];
    }
}
