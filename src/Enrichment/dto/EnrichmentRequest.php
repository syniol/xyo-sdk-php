<?php

namespace XYO\SDK\Enrichment\dto;
class EnrichmentRequest
{
    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $countryCode;

    /**
     * @param string $content
     * @param string $countryCode
     */
    public function __construct(string $content, string $countryCode)
    {
        $this->content = $content;
        $this->countryCode = $countryCode;
    }
}
