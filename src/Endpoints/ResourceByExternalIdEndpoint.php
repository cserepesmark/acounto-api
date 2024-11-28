<?php

namespace Cserepesmark\AcountoApi\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class ResourceByExternalIdEndpoint
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    public function getResource(string $externalId): PromiseInterface|Response
    {
        return $this->client->get("/api/v1/resources/resource-by-external-id/{$externalId}");
    }
}
