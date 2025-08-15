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
            "https://api.xyo.financial/healthz",
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->clientConfig->getApiKey())
                ],
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        return true;
    }

    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        return $this->enrichment->enrichTransaction($req);
    }

    public function enrichTransactionCollection(EnrichmentRequest $req): EnrichTransactionCollectionResponse
    {
        return $this->enrichment->enrichTransactionCollection($req);
    }

    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        return $this->enrichment->enrichTransactionCollectionStatus($id);
    }
}
