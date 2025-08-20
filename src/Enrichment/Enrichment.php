<?php

namespace XYO\SDK\Enrichment;

use XYO\SDK\ClientException;
use XYO\SDK\Enrichment\DTO\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;
use XYO\SDK\Enrichment\DTO\EnrichmentResponse;
use XYO\SDK\Enrichment\DTO\EnrichTransactionCollectionResponse;

interface Enrichment
{
    /**
     * @throws ClientException
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse;

    /**
     * @param EnrichmentRequest[] $req
     * @throws ClientException
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse;

    /**
     * @throws ClientException
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse;
}
