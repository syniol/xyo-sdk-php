<?php

namespace XYO\SDK\Enrichment\dto;
class EnrichmentRequest
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @param string $content
     * @param string $countryCode
     */
    public function __construct(string $content, string $countryCode)
    {
        $this->content = $content;
        $this->countryCode = $countryCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
