<?php

namespace App\Http\Resources\auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected int $httpCode;
    protected string $token;

    public function __construct(string $token,int $httpCode)
    {
        parent::__construct($httpCode);
        $this->httpCode = $httpCode;
        $this->token = $token;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => false,
            'token' => $this->token,
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode($this->httpCode);
    }
}
