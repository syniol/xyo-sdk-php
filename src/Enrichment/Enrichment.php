<?php

namespace XYO\SDK\Enrichment;

use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;

interface Enrichment {
    /**
     * @param EnrichmentRequest $req
     * @return EnrichmentResponse
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse;

    /**
     * @param EnrichmentRequest[] $req
     * @return EnrichTransactionCollectionResponse
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse;

    /**
     * @param string $id
     * @return EnrichmentCollectionStatusResponse
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse;
}
