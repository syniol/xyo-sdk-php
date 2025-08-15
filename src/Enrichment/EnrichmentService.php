<?php

namespace XYO\SDK\Enrichment;

use XYO\SDK\ClientConfig;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;
use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;

class EnrichmentService implements Enrichment
{
    /**
     * @var ClientConfig
     */
    private $clientConfig;

    public function __construct(ClientConfig $clientConfig)
    {
        $this->clientConfig = $clientConfig;
    }

    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        return new EnrichmentResponse(
            "",
            "",
            "",
            [
                "blah",
            ]
        );
    }

    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        return new EnrichTransactionCollectionResponse();
    }

    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        return new EnrichmentCollectionStatusResponse();
    }
}
