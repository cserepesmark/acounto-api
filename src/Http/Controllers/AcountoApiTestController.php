<?php

namespace Cserepesmark\AcountoApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Cserepesmark\AcountoApi\AcountoApiClient;

class AcountoApiTestController
{
    protected AcountoApiClient $client;

    public function __construct(AcountoApiClient $client)
    {
        $this->client = $client;
    }

    public function uploadExample(): JsonResponse
    {
        $response = $this->client->upload()->uploadFile([
            'resourceType' => 'income',
            'externalId' => 'example-id-123',
            'description' => 'Example description',
            'file' => base64_encode('Example file content'),
        ]);

        return response()->json($response->json(), $response->status());
    }

    public function existsExample(): JsonResponse
    {
        $response = $this->client->exists()->checkIfExists('example-id-123');
        return response()->json($response->json(), $response->status());
    }

    public function resourceExample(): JsonResponse
    {
        $response = $this->client->resourceByExternalId()->getResource('example-id-123');
        return response()->json($response->json(), $response->status());
    }
}
