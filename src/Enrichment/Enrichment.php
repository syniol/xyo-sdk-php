<?php

namespace XYO\SDK\Enrichment;

use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;

interface Enrichment {
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse;

    public function enrichTransactionCollection(EnrichmentRequest $req): EnrichTransactionCollectionResponse;

    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse;
}
