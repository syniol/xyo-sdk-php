<?php

namespace XYO\SDK\Enrichment\DTO;
class EnrichmentCollectionStatusResponse
{
    public static $EnrichmentCollectionStatusReady =  "READY";
	public static $EnrichmentCollectionStatusFailure = "FAILED";
	public static $EnrichmentCollectionStatusPending = "PENDING";

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
