<?php

namespace Tests\Enrichment\DTO;

use PHPUnit\Framework\TestCase;
use XYO\SDK\Enrichment\DTO\EnrichmentResponse;

class EnrichmentResponseTest extends TestCase
{
    /**
     * @var EnrichmentResponse
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new EnrichmentResponse(
            'Costa Coffee',
            'Coffee house',
            'base64/encoded string mostly png',
            ['coffee', 'lunch', 'cake']
        );
    }

    public function testShouldHaveMerchantName(): void
    {
        $this->assertEquals('Costa Coffee', $this->sut->merchant);
    }

    public function testShouldHaveMerchantDescription(): void
    {
        $this->assertEquals('Coffee house', $this->sut->description);
    }

    public function testShouldHaveCategoriesAssociatedWithMerchant(): void
    {
        $this->assertEquals(['coffee', 'lunch', 'cake'], $this->sut->categories);
    }

    public function testShouldHaveMerchantLogo(): void
    {
        $this->assertEquals('base64/encoded string mostly png', $this->sut->logo);
    }

    public function testShouldEncodeSingleEnrichmentRequestToJSONResponse(): void
    {
        $this->assertEquals(
            '{"merchant":"Costa Coffee","description":"Coffee house","categories":["coffee","lunch","cake"],"logo":"base64\/encoded string mostly png"}',
            json_encode($this->sut),
            'should encode to JSON'
        );
    }
}
