<?php

namespace XYO\SDK;

use \Exception;
use XYO\SDK\ClientConfig;
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
 * use XYO\SDK\Enrichment\dto\EnrichmentRequest;
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
     * @throws Exception
     */
    public function getHeath(): bool
    {
        $resp = $this->clientConfig->getHttpClient()->get(
            sprintf("%s/healthz", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            // todo: action 3 Vs 4-5 JSON vs text
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        return $this->enrichment->enrichTransaction($req);
    }

    /**
     * @throws Exception
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        return $this->enrichment->enrichTransactionCollection($req);
    }

    /**
     * @throws Exception
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        return $this->enrichment->enrichTransactionCollectionStatus($id);
    }
}
