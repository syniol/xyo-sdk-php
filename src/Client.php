<?php

namespace XYO\SDK;

use \Exception;
use XYO\SDK\ClientConfig;

class Client
{
    /**
     * @var ClientConfig
     */
    private $clientConfig;

    public function __construct(ClientConfig $clientConfig)
    {
        $this->clientConfig = $clientConfig;
    }

    /**
     * @throws Exception
     */
    public function getHeath(): bool
    {
        $resp = $this->clientConfig->getHttpClient()->get(
            "https://api.xyo.financial/healthz",
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->clientConfig->getApiKey())
                ],
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        return true;
    }
}
