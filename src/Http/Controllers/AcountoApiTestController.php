<?php

namespace Cserepesmark\AcountoApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Cserepesmark\AcountoApi\AcountoApiClient;
use Illuminate\Support\Facades\Storage;

class AcountoApiTestController
{
    protected AcountoApiClient $client;

    public function __construct(AcountoApiClient $client)
    {
        $this->client = $client;
    }

    public function uploadExample(): JsonResponse
    {
        $filePath = 'testing/AB-2024-01.pdf';

        $fileContent = Storage::disk('local')->get($filePath);
        $fileName = basename($filePath);

        $response = $this->client->upload()->uploadFile($fileContent, $fileName, [
            'resourceType' => 'expense',
            'externalId' => 'example-id-123',
            'description' => 'Example description',
            'invoiceNumber' => 'AB-2024-01',
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

    public function resourceByDateExample(): JsonResponse
    {
        $response = $this->client->resourceByDates()->getResourcesByDates([
            'fromDate' => '2024-01-01',
            'toDate' => '2024-12-31',
        ]);
        return response()->json($response->json(), $response->status());
    }
}
