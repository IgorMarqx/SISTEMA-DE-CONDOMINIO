<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    protected $error;
    protected $message;

    public function __construct(bool $error, string $message)
    {
        parent::__construct($error, $message);
        $this->error = $error;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => $this->error,
            'message' => $this->message . '.'
        ];
    }
}
