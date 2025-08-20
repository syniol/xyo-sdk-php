<?php

namespace XYO\SDK\Enrichment;

use \Throwable;
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
     * @throws Throwable
     */
    public function enrichTransaction(EnrichmentRequest $req): EnrichmentResponse
    {
        $resp = $this->clientConfig->getHttpClient()->request(
            'POST',
            sprintf("%s/v1/ai/finance/enrichment/transaction", ClientConfig::API_PATH),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => GuzzleHttp\json_encode($req)
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== ClientConfig::DEFAULT_SUCCESS_STATUS_CODE) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents(), true);

        return new EnrichmentResponse(
            $responseBody['merchant'],
            $responseBody['description'],
            $responseBody['logo'],
            $responseBody['categories']
        );
    }

    /**
     * @param EnrichmentRequest[] $req
     * @throws Throwable
     */
    public function enrichTransactionCollection(array $req): EnrichTransactionCollectionResponse
    {
        $resp = $this->clientConfig->getHttpClient()->request(
            'POST',
            sprintf("%s/v1/ai/finance/enrichment/transactions", ClientConfig::API_PATH),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
                'body' => GuzzleHttp\json_encode($req)
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== ClientConfig::DEFAULT_SUCCESS_STATUS_CODE) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents(), true);

        return new EnrichTransactionCollectionResponse(
            $responseBody['id'],
            $responseBody['link']
        );
    }

    /**
     * @throws ClientException
     * @throws Throwable
     */
    public function enrichTransactionCollectionStatus(string $id): EnrichmentCollectionStatusResponse
    {
        $resp = $this->clientConfig->getHttpClient()->request(
            'GET',
            sprintf(
                "%s/v1/ai/finance/enrichment/transactions/status/%s",
                ClientConfig::API_PATH,
                $id
            ),
            [
                'headers' => $this->clientConfig->getHttpClientHeaders(),
            ]
        );

        $httpStatusCode = $resp->getStatusCode();
        if ($httpStatusCode !== ClientConfig::DEFAULT_SUCCESS_STATUS_CODE) {
            throw ClientException::ExceptionFromHttpStatusCode(
                $httpStatusCode,
                $resp->getBody()->getContents()
            );
        }

        $responseBody = GuzzleHttp\json_decode($resp->getBody()->getContents(), true);

        return new EnrichmentCollectionStatusResponse($responseBody['status']);
    }
}
