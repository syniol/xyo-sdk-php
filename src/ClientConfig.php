<?php

namespace XYO\SDK;

use Exception;
use GuzzleHttp\Client as HttpClient;

class ClientConfig {

    /**
     * @var string
     */
    private static $ApiPath = 'https://api.xyo.financial';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var array
     */
    private $httpClientHeaders;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient();
        $this->httpClientHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', $apiKey)
        ];
    }

    public static function getApiPath(): string
    {
        return self::$ApiPath;
    }

    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function getHttpClientHeaders(): array
    {
        return $this->httpClientHeaders;
    }
}
