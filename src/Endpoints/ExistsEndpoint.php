<?php

namespace Cserepesmark\AcountoApi\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class ExistsEndpoint
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    public function checkIfExists(string $externalId): PromiseInterface|Response
    {
        return $this->client->get("/api/v1/resources/exists/{$externalId}");
    }
}
