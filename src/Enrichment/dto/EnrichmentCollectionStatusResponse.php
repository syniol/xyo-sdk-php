<?php

namespace XYO\SDK\Enrichment\dto;
class EnrichmentCollectionStatusResponse
{
    private static $EnrichmentCollectionStatusReady =  "READY";
	private static $EnrichmentCollectionStatusFailure = "FAILED";
	private static $EnrichmentCollectionStatusPending = "PENDING";

    public static function getEnrichmentCollectionStatusReady(): string
    {
        return self::$EnrichmentCollectionStatusReady;
    }

    public static function getEnrichmentCollectionStatusFailure(): string
    {
        return self::$EnrichmentCollectionStatusFailure;
    }

    public static function getEnrichmentCollectionStatusPending(): string
    {
        return self::$EnrichmentCollectionStatusPending;
    }

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
