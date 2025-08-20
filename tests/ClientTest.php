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

    public function _testShouldThrowExceptionWhenEnrichTransactionReturnsNonSuccessfulStatusCode(): void
    {
//        $this->expectException(ClientException::class);
        $mockedHttpResponse = $this
            ->getMockBuilder(ResponseInterface::class)
            ->setMockClassName('Response')
            ->getMock();

        $mockedHttpResponse
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(400);



        $mockedHttpResponse
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($mockedBody);

        $mockedBody = $this
            ->getMockBuilder(MessageInterface::class)
            ->setMockClassName('Message')
            ->getMock();

        $mockedBody
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('errorsssss');

        $this->httpClient
            ->expects($this->once())
            ->method('request')
            ->willReturn($mockedHttpResponse);

        $this->sut->enrichTransaction(new EnrichmentRequest('Syniol Tech', 'GB'));

//        $this->clientConfig
//            ->expects($this->once())
//            ->method('getHttpClientHeaders')
//            ->willReturn(['Content-Type' => 'application/json']);
    }
}
