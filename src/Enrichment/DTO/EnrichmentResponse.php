<?php

namespace XYO\SDK\Enrichment\DTO;

class EnrichmentResponse
{
    /**
     * @var string
     */
    public $merchant;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string[]
     */
    public $categories;

    /**
     * @var string
     */
    public $logo;

    /**
     * @param string $merchant
     * @param string $description
     * @param string $logo
     * @param string[] $categories
     */
    public function __construct(string $merchant, string $description, string $logo, array $categories)
    {
        $this->merchant = $merchant;
        $this->description = $description;
        $this->logo = $logo;
        $this->categories = $categories;
    }
}
