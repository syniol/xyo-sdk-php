<?php

namespace XYO\SDK\Enrichment;

use Exception;
use XYO\SDK\ClientConfig;
use XYO\SDK\Enrichment\dto\EnrichmentRequest;
use XYO\SDK\Enrichment\dto\EnrichmentResponse;
use XYO\SDK\Enrichment\dto\EnrichTransactionCollectionResponse;
use XYO\SDK\Enrichment\dto\EnrichmentCollectionStatusResponse;

class EnrichmentService implements Enrichment
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
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        $resp = $this->clientConfig->getHttpClient()->post(
            sprintf("%s/v1/ai/finance/enrichment/transaction", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => \GuzzleHttp\json_encode($req)
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            // todo: action 3 Vs 4-5 JSON vs text
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        $responseBody = \GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichmentResponse(
            $responseBody['merchant'],
            $responseBody['description'],
            $responseBody['logo'],
            $responseBody['categories']
        );
    }


    /**
     * @param EnrichmentResponse[] $req
     * @throws Exception
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        $resp = $this->clientConfig->getHttpClient()->post(
            sprintf("%s/v1/ai/finance/enrichment/transactions", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => \GuzzleHttp\json_encode($req)
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            // todo: action 3 Vs 4-5 JSON vs text
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        $responseBody = \GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichTransactionCollectionResponse(
            $responseBody['id'],
            $responseBody['link']
        );
    }

    /**
     * @throws Exception
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        $resp = $this->clientConfig->getHttpClient()->get(
            sprintf(
                "%s/v1/ai/finance/enrichment/transactions/status/%s",
                ClientConfig::getApiPath(),
                $id
            ),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
            ]
        );

        if ($resp->getStatusCode() !== 200) {
            // todo: action 3 Vs 4-5 JSON vs text
            throw new Exception(\GuzzleHttp\json_decode($resp->getBody()->getContents()));
        }

        $responseBody = \GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichmentCollectionStatusResponse($responseBody['status']);
    }
}
