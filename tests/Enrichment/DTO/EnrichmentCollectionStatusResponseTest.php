<?php

namespace Tests\Enrichment\DTO;

use PHPUnit\Framework\TestCase;
use XYO\SDK\Enrichment\DTO\EnrichmentCollectionStatusResponse;

class EnrichmentCollectionStatusResponseTest extends TestCase
{
    /**
     * @var EnrichmentCollectionStatusResponse
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new EnrichmentCollectionStatusResponse(EnrichmentCollectionStatusResponse::$EnrichmentCollectionStatusReady);
    }

    public function testShouldBeInstantiable(): void {
        $this->assertInstanceOf(EnrichmentCollectionStatusResponse::class, $this->sut);
    }

    public function testShouldHaveStatusCode(): void
    {
        $this->assertEquals(EnrichmentCollectionStatusResponse::$EnrichmentCollectionStatusReady, $this->sut->status);
    }

    public function testShouldEncodeSingleEnrichmentRequestToJSONResponse(): void
    {
        $this->assertEquals(
            sprintf('{"status":"%s"}', EnrichmentCollectionStatusResponse::$EnrichmentCollectionStatusReady),
            json_encode($this->sut),
            'should encode to JSON'
        );
    }
}
