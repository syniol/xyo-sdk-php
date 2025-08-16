<?php

namespace XYO\SDK\Enrichment;

use XYO\SDK\ClientException;
use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;

interface Enrichment
{
    /**
     * @throws ClientException
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse;

    /**
     * @param EnrichmentResponse[] $req
     * @throws ClientException
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse;

    /**
     * @throws ClientException
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse;
}
