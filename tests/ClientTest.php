<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use XYO\SDK\Client;
use XYO\SDK\ClientConfig;
use GuzzleHttp\Client as HttpClient;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new Client($this->createMock(ClientConfig::class));
    }

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(Client::class, $this->sut);
    }
}
