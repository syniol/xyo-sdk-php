<?php

namespace XYO\SDK\Enrichment\DTO;
class EnrichmentCollectionStatusResponse
{
    public const EnrichmentCollectionStatusReady =  "READY";
	public const EnrichmentCollectionStatusFailure = "FAILED";
	public const EnrichmentCollectionStatusPending = "PENDING";

    /**
     * @var string
     * Possible values are: READY, FAILED, PENDING
     */
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
}
