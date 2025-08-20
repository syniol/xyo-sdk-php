<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use XYO\SDK\Client;
use XYO\SDK\ClientConfig;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\MessageInterface;
use XYO\SDK\ClientException;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;
use XYO\SDK\Enrichment\DTO\EnrichmentResponse;
use XYO\SDK\Enrichment\EnrichmentService;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $sut;

    private $clientConfig;

    private $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClient::class);
        $this->clientConfig = $this->createMock(ClientConfig::class);
        $this->clientConfig
            ->method('getHttpClient')
            ->willReturn($this->httpClient);

        $this->sut = new Client($this->clientConfig);
    }

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(Client::class, $this->sut);
    }

    public function _testShouldExecuteEnrichTransaction(): void
    {
        $this->sut->enrichTransaction(new EnrichmentRequest('sssdsdda', 'GB'));
    }
}
