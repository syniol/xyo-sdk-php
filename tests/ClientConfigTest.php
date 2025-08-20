<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as HttpClient;
use XYO\SDK\ClientConfig;

class ClientConfigTest extends TestCase
{
    /**
     * @var ClientConfig
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new ClientConfig('ApiKeyForUniTest');
    }

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(ClientConfig::class, $this->sut);
    }

    public function testShouldHaveAccessibleHttpClient(): void
    {
        $this->assertInstanceOf(HttpClient::class, $this->sut->getHttpClient());
    }

    public function testShouldHaveHttpClientHeadersIncludingAuthorizationAPIKey(): void
    {
        $this->assertEquals([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', 'ApiKeyForUniTest')
        ], $this->sut->getHttpClientHeaders());
    }
}
