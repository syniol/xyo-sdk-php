<?php

namespace XYO\SDK\Enrichment\dto;

class EnrichmentResponse
{
    /**
     * @var string
     */
    private $merchant;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string[]
     */
    private $categories;

    /**
     * @var string
     */
    private $logo;

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

    public function getMerchant(): string
    {
        return $this->merchant;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }
}
