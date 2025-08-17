<?php

namespace Tests\DTO;

use PHPUnit\Framework\TestCase;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;

class EnrichmentRequestTest extends TestCase
{
    /**
     * @var EnrichmentRequest
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new EnrichmentRequest(
            'COSTA PICKUP',
            'GB'
        );
    }

    function testShouldBeInstantiable(): void {
        $this->assertInstanceOf(EnrichmentRequest::class, $this->sut);
    }
}
