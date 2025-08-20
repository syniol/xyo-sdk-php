# XYO Financial SDK for PHP
![workflow](https://github.com/syniol/xyo-sdk-php/actions/workflows/makefile.yml/badge.svg)    ![workflow](https://github.com/syniol/xyo-sdk-php/actions/workflows/packagist_publish.yml/badge.svg)

This is an official SDK of XYO Financial for PHP Programming Language. 
The minimum requirement is PHP version: `7.1.33`.


## Quickstart Guide
Client is an entry point to use the SDK. You need a valid API Key obtainable from https://xyo.financial/dashboard

__Create a Client__:
```php
use XYO\SDK\Client;
use XYO\SDK\ClientConfig;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;

$client = new Client(new ClientConfig("YourAPIKeyFromXYO.FinancialDashboard"))
```

__Enrich a Single Payment Transaction__:
```php
$enrichmentResult = $client->enrichTransaction(new EnrichmentRequest("Costa PickUp", "GB"));

echo $enrichmentResult->merchant;
echo $enrichmentResult->description;
```

__Enrich Payment Transaction Collection _(Bulk Enrichment)___:
```php
$enrichmentCollectionResult = $client->enrichTransactionCollection([
    new EnrichmentRequest("Costa PickUp", "GB"),
    new EnrichmentRequest("STRBUKS GREENWICH", "GB")
]);

echo $enrichmentCollectionResult->id;
echo $enrichmentCollectionResult->link;
```

__Payment Transaction Collection Status__:
```php
$enrichmentCollectionStatusResult = $client->enrichTransactionCollectionStatus($enrichmentCollectionResult->id);

echo $enrichmentCollectionStatusResult->getStatus();
```


#### Credits
Copyright &copy; 2025 Syniol Limited. All rights reserved.
