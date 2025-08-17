<?php

namespace XYO\SDK\Enrichment;

use GuzzleHttp;
use XYO\SDK\ClientException;
use XYO\SDK\ClientConfig;
use XYO\SDK\Enrichment\DTO\EnrichmentRequest;
use XYO\SDK\Enrichment\DTO\EnrichmentResponse;
use XYO\SDK\Enrichment\DTO\EnrichTransactionCollectionResponse;
use XYO\SDK\Enrichment\DTO\EnrichmentCollectionStatusResponse;

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
     * @throws ClientException
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        $resp = $this->clientConfig->getHttpClient()->post(
            sprintf("%s/v1/ai/finance/enrichment/transaction", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => GuzzleHttp\json_encode($req)
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== 200) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichmentResponse(
            $responseBody['merchant'],
            $responseBody['description'],
            $responseBody['logo'],
            $responseBody['categories']
        );
    }

    /**
     * @param EnrichmentResponse[] $req
     * @throws ClientException
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        $resp = $this->clientConfig->getHttpClient()->post(
            sprintf("%s/v1/ai/finance/enrichment/transactions", ClientConfig::getApiPath()),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => GuzzleHttp\json_encode($req)
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== 200) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichTransactionCollectionResponse(
            $responseBody['id'],
            $responseBody['link']
        );
    }

    /**
     * @throws ClientException
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

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== 200) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents());

        return new EnrichmentCollectionStatusResponse($responseBody['status']);
    }
}
