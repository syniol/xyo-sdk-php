<?php

namespace XYO\SDK\Enrichment\dto;
class EnrichmentCollectionStatusResponse
{
    public static $EnrichmentCollectionStatusReady =  "READY";
	public static $EnrichmentCollectionStatusFailure = "FAILED";
	private static $EnrichmentCollectionStatusPending = "PENDING";

    /**
     * @var string
     * Possible values are: READY, FAILED, PENDING
     */
    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
