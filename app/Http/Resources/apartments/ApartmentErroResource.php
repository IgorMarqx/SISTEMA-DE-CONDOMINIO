<?php

namespace App\Http\Resources\apartments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentErroResource extends JsonResource
{
    protected $errorMessage;

    public function __construct($message)
    {
        parent::__construct(null);
        $this->errorMessage = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => true,
            'message' => $this->errorMessage . '.'
        ];
    }
}
