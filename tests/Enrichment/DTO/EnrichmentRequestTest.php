<?php

namespace Tests\Enrichment\DTO;

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

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(EnrichmentRequest::class, $this->sut);
    }

    public function testShouldEncodeSingleEnrichmentRequestToJSONResponse(): void
    {
        $this->assertEquals(
            '{"content":"COSTA PICKUP","countryCode":"GB"}',
            json_encode($this->sut),
            'should encode to JSON response'
        );
    }

    public function testShouldEncodeCollectionEnrichmentRequestToJSONResponse(): void
    {
        $this->assertEquals(
            '[{"content":"COSTA PICKUP","countryCode":"GB"},{"content":"COSTA PICKUP","countryCode":"GB"}]',
            json_encode([$this->sut, $this->sut]),
            'should encode to JSON response'
        );
    }
}
