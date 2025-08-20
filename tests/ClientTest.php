<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use XYO\SDK\Client;
use XYO\SDK\ClientConfig;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new Client(new ClientConfig('ApiKeyForUniTest'));
    }

    public function testShouldBeInstantiable(): void
    {
        $this->assertInstanceOf(Client::class, $this->sut);
    }
}
