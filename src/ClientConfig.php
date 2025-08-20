<?php

namespace XYO\SDK;

use GuzzleHttp\Client as HttpClient;

class ClientConfig
{
    /**
     * @var string
     */
    public const API_PATH = 'https://api.xyo.financial';

    /**
     * @var int
     */
    public const DEFAULT_SUCCESS_STATUS_CODE = 200;

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
        $this->httpClient = new HttpClient();
        $this->httpClientHeaders = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', $apiKey)
        ];
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
