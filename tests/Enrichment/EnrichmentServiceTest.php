<?php

namespace Tests\Enrichment;

use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use XYO\SDK\ClientConfig;
use XYO\SDK\ClientException;
use XYO\SDK\Enrichment\DTO\EnrichmentCollectionStatusResponse;
use XYO\SDK\Enrichment\DTO\EnrichTransactionCollectionResponse;
use XYO\SDK\Enrichment\EnrichmentService;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;
use XYO\SDK\Enrichment\DTO\EnrichmentResponse;

class EnrichmentServiceTest extends TestCase
{
    /**
     * @var EnrichmentService
     */
    private $sut;

    /**
     * @var ClientConfig | MockObject
     */
    private $clientConfig;

    protected function setUp(): void
    {
        $this->clientConfig = $this->createMock(ClientConfig::class);

        $this->sut = new EnrichmentService($this->clientConfig);
    }

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(EnrichmentService::class, $this->sut);
    }

    public function testShouldThrowExceptionWhenEnrichTransactionReturnsNonSuccessfulStatusCode(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Unexpected error requesting API endpoint');

        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $responseInterfaceMock
            ->method('getStatusCode')
            ->willReturn(300);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->method('getContents')
            ->willReturn('Unexpected error requesting API endpoint');
        $responseInterfaceMock
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $this->sut->enrichTransaction(new EnrichmentRequest('Syniol Tech', 'GB'));
    }

    public function testShouldEnrichTransactionSuccessfully(): void
    {
        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('{"merchant":"Syniol", "description":"","logo":"","categories":[""]}');
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $actual = $this->sut->enrichTransaction(new EnrichmentRequest('Syniol', 'GB'));

        $this->assertInstanceOf(EnrichmentResponse::class, $actual);
    }

    public function testShouldThrowExceptionWhenEnrichTransactionCollectionReturnsNonSuccessfulStatusCode(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Unexpected error requesting API endpoint');

        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $responseInterfaceMock
            ->method('getStatusCode')
            ->willReturn(300);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->method('getContents')
            ->willReturn('Unexpected error requesting API endpoint');
        $responseInterfaceMock
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $this->sut->enrichTransactionCollection([new EnrichmentRequest('Syniol Tech', 'GB')]);
    }

    public function testShouldEnrichTransactionCollectionSuccessfully(): void
    {
        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('{"id":"23123-123123-3124213-2", "link":""}');
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $actual = $this->sut->enrichTransactionCollection([new EnrichmentRequest('Syniol', 'GB')]);

        $this->assertInstanceOf(EnrichTransactionCollectionResponse::class, $actual);
    }

    public function testShouldThrowExceptionWhenEnrichTransactionCollectionStatusReturnsNonSuccessfulStatusCode(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Unexpected error requesting API endpoint');

        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();

        $responseInterfaceMock
            ->method('getStatusCode')
            ->willReturn(300);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->method('getContents')
            ->willReturn('Unexpected error requesting API endpoint');
        $responseInterfaceMock
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $this->sut->enrichTransactionCollectionStatus('7820-32323ds-32-32323-2');
    }

    public function testShouldEnrichTransactionCollectionStatusSuccessfully(): void
    {
        $httpClientMock = $this
            ->createMock(HttpClient::class);

        $responseInterfaceMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->getMock();
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $streamInterfaceMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->getMock();
        $streamInterfaceMock
            ->expects($this->once())
            ->method('getContents')
            ->willReturn(sprintf('{"status":"%s"}', EnrichmentCollectionStatusResponse::READY));
        $responseInterfaceMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($streamInterfaceMock);

        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseInterfaceMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClientMock);

        $this->clientConfig
            ->expects($this->once())
            ->method('getHttpClientHeaders')
            ->willReturn(['Content-Type' => 'application/json']);

        $actual = $this->sut->enrichTransactionCollectionStatus('3213-3123123-3213142132-32132');

        $this->assertInstanceOf(EnrichmentCollectionStatusResponse::class, $actual);
    }
}
