## Configuration

The configuration file `config/acounto-api.php` contains the following settings:

```php
return [
    'api_key' => env('ACOUNTO_API_KEY', ''),
    'base_url' => env('ACOUNTO_ENV', 'dev') === 'prod'
        ? 'https://bulk.acounto.com/'
        : 'https://bulk.acounto.dev/',
];
```

## Usage
Initializing the Client
You can initialize the API client in your application like this:

```php
use Cserepesmark\AcountoApi\AcountoApiClient;

$client = new AcountoApiClient();
```

## Uploading a File
To upload a file, use the upload() method:

```php
$fileContent = Storage::disk('local')->get($filePath);
$fileName = basename($filePath);

$response = $client->upload()->uploadFile($fileContent, $fileName, [
    'resourceType' => 'expense',
    'externalId' => 'example-id-123',
    'description' => 'Example description',
    'invoiceNumber' => 'AB-2024-01',
]);

echo $response->json();
```

## Checking if a Resource Exists
To check if a resource exists by its external ID:

```php
$response = $client->exists()->checkIfExists('example-id-123');

if ($response->json('exists')) {
    echo "The resource exists!";
} else {
    echo "The resource does not exist.";
}
```

## Querying a Resource by External ID
To query a resource by its external ID:


```php
$response = $client->resourceByExternalId()->getResource('example-id-123');

echo $response->json();
```

## Querying Resources by Dates
To query resources uploaded within a date range:

```php
$response = $client->resourceByDates()->getResourcesByDates([
    'page' => 0,
    'size' => 100,
    'fromDate' => '2024-01-01',
    'toDate' => '2024-12-31',
]);

print_r($response->json());
```

## Example Routes
For quick testing, you can add the following routes to your application:

```php
use Cserepesmark\AcountoApi\Http\Controllers\AcountoApiTestController;

Route::get('/acounto/upload', [AcountoApiTestController::class, 'uploadExample']);
Route::get('/acounto/exists', [AcountoApiTestController::class, 'existsExample']);
Route::get('/acounto/resource', [AcountoApiTestController::class, 'resourceExample']);
```

