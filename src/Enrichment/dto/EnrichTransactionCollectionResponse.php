<?php

namespace XYO\SDK\Enrichment\dto;

class EnrichTransactionCollectionResponse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $link;

    public function __construct(string $id, string $link)
    {
        $this->id = $id;
        $this->link = $link;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
