<?php

namespace Cserepesmark\AcountoApi\Endpoints;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class ResourceByDatesEndpoint
{
    protected PendingRequest $client;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    public function getResourcesByDates(array $queryParams): PromiseInterface|Response
    {
        return $this->client->get('/api/v1/resources/resource-by-dates', $queryParams);
    }
}
