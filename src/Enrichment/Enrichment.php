<?php

namespace XYO\SDK\Enrichment;

use Exception;
use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;

interface Enrichment {
    /**
     * @throws Exception
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse;

    /**
     * @param EnrichmentResponse[] $req
     * @throws Exception
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse;

    /**
     * @throws Exception
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse;
}
