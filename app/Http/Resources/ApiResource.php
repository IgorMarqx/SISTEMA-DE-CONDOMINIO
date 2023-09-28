<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    protected array $data;
    protected int $httpCode;

    public function __construct(array $data, $httpCode)
    {
        parent::__construct($data);
        $this->data['error'] = $data['error'];
        $this->data['message'] = $data['message'];
        $this->httpCode = $httpCode;
    }

    public function toArray(Request $request): array
    {
        return [
            'error' => $this->data['error'],
            'message' => $this->data['message'] . '.',
            'timestamp' => date('Y-m-d H:i:s'),
            'path' => $request->fullUrl(),
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode($this->httpCode);
    }
}
