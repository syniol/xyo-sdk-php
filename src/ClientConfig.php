<?php

namespace XYO\SDK;

use Exception;
use GuzzleHttp\Client as HttpClient;

class ClientConfig {
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient();
    }

    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}
