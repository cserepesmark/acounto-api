<?php

namespace Cserepesmark\AcountoApi\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class UploadEndpoint
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    public function uploadFile(string $fileContent, string $fileName, array $data): PromiseInterface|Response
    {
        return $this->client
            ->attach('file', $fileContent, $fileName)
            ->post('/api/v1/resources/upload', $data);
    }
}
