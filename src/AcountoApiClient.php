<?php

namespace Cserepesmark\AcountoApi;

use Cserepesmark\AcountoApi\Endpoints\ExistsEndpoint;
use Cserepesmark\AcountoApi\Endpoints\ResourceByDatesEndpoint;
use Cserepesmark\AcountoApi\Endpoints\ResourceByExternalIdEndpoint;
use Cserepesmark\AcountoApi\Endpoints\UploadEndpoint;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AcountoApiClient
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('acounto-api.base_url');
        $this->apiKey = config('acounto-api.api_key');
    }

    protected function client(): PendingRequest
    {
        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Accept' => 'application/json',
        ])->baseUrl($this->baseUrl);
    }

    public function upload(): UploadEndpoint
    {
        return new UploadEndpoint($this->client());
    }

    public function exists(): ExistsEndpoint
    {
        return new ExistsEndpoint($this->client());
    }

    public function resourceByExternalId(): ResourceByExternalIdEndpoint
    {
        return new ResourceByExternalIdEndpoint($this->client());
    }

    public function resourceByDates(): ResourceByDatesEndpoint
    {
        return new ResourceByDatesEndpoint($this->client());
    }
}
