<?php

namespace XYO\SDK\Enrichment\DTO;
class EnrichmentCollectionStatusResponse
{
    public const READY =  "READY";
	public const FAILED = "FAILED";
	public const PENDING = "PENDING";

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
