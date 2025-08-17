<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
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
}
