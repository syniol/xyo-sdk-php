<?php

namespace Tests\Enrichment\DTO;

use PHPUnit\Framework\TestCase;
use XYO\SDK\Enrichment\DTO\EnrichTransactionCollectionResponse;

class EnrichTransactionCollectionResponseTest extends TestCase
{
    /**
     * @var EnrichTransactionCollectionResponse
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new EnrichTransactionCollectionResponse(
            'c93710be-307a-4185-9cd1-02b85f1b7d26',
            'https://api.xyo.financial/download/c93710be-307a-4185-9cd1-02b85f1b7d26.tar.gz'
        );
    }

    public function testShouldBeInstantiable(): void {
        $this->assertInstanceOf(EnrichTransactionCollectionResponse::class, $this->sut);
    }

    public function testShouldHaveUniqueId(): void
    {
        $this->assertEquals('c93710be-307a-4185-9cd1-02b85f1b7d26', $this->sut->id);
    }

    public function testShouldHaveDownloadLink(): void
    {
        $this->assertEquals('https://api.xyo.financial/download/c93710be-307a-4185-9cd1-02b85f1b7d26.tar.gz', $this->sut->link);
    }

    public function testShouldEncodeToJSONContainingAllPublicProperties(): void
    {
        $this->assertEquals(
            '{"id":"c93710be-307a-4185-9cd1-02b85f1b7d26","link":"https:\/\/api.xyo.financial\/download\/c93710be-307a-4185-9cd1-02b85f1b7d26.tar.gz"}',
            json_encode($this->sut),
            'should encode to JSON'
        );
    }
}
