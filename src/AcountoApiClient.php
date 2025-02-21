<?php

namespace Cserepesmark\AcountoApi;

use App\Models\Stakeholder;
use Cserepesmark\AcountoApi\Endpoints\ExistsEndpoint;
use Cserepesmark\AcountoApi\Endpoints\ResourceByDatesEndpoint;
use Cserepesmark\AcountoApi\Endpoints\ResourceByExternalIdEndpoint;
use Cserepesmark\AcountoApi\Endpoints\UploadEndpoint;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AcountoApiClient
{
    protected string $baseUrl;
    protected Stakeholder $stakeholder;

    public function __construct(Stakeholder $stakeholder)
    {
        $this->stakeholder = $stakeholder;

        $this->baseUrl = config('acounto-api.base_url');
    }

    protected function client(): PendingRequest
    {
        return Http::withHeaders([
            'x-api-key' => $this->stakeholder->acounto_api_key,
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
