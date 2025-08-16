<?php

namespace XYO\SDK;

use XYO\SDK\Enrichment\Enrichment;
use XYO\SDK\Enrichment\EnrichmentService;
use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;

/**
 * Client is an entry point to use the SDK. You need a valid API Key obtainable from https://xyo.financial/dashboard
 * e.g.
 *
 * use XYO\SDK\Client;
 * use XYO\SDK\ClientConfig;
 * use XYO\SDK\Enrichment\DTO\EnrichmentRequest;
 *
 * $client = new Client(new ClientConfig("YourAPIKeyFromXYO.FinancialDashboard"))
 * $enrichmentResult = $client->enrichTransaction(new EnrichmentRequest("Costa PickUp", "GB"));
 *
 * echo $enrichmentResult->merchant;
 * echo $enrichmentResult->description;
 *
 *
 * $enrichmentCollectionResult = $client->enrichTransactionCollection([
 *     new EnrichmentRequest("Costa PickUp", "GB"),
 *     new EnrichmentRequest("STRBUKS GREENWICH", "GB")
 * ]);
 *
 * echo $enrichmentCollectionResult->id;
 * echo $enrichmentCollectionResult->link;
 *
 */
class Client implements Enrichment
{
    /**
     * @var ClientConfig
     */
    private $clientConfig;

    /**
     * @var Enrichment
     */
    private $enrichment;

    public function __construct(ClientConfig $clientConfig)
    {
        $this->clientConfig = $clientConfig;

        // All Services such as enrichment should implement interface and assigned here
        $this->enrichment = new EnrichmentService($clientConfig);
    }

    /**
     * @throws ClientException
     */
    public function getHeath(): bool
    {
        $resp = $this->clientConfig->getHttpClient()->get(
            sprintf("%s/healthz", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $resp->getStatusCode(),
                $resp->getBody()->getContents()
            );
        }

        return true;
    }

    /**
     * @throws ClientException
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        return $this->enrichment->enrichTransaction($req);
    }

    /**
     * @param EnrichmentResponse[] $req
     * @throws ClientException
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        return $this->enrichment->enrichTransactionCollection($req);
    }

    /**
     * @throws ClientException
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        return $this->enrichment->enrichTransactionCollectionStatus($id);
    }
}
