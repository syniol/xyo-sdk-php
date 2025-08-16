<?php

namespace XYO\SDK\Enrichment\DTO;

class EnrichTransactionCollectionResponse
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $link;

    public function __construct(string $id, string $link)
    {
        $this->id = $id;
        $this->link = $link;
    }
}
