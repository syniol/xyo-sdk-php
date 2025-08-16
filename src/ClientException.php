<?php

namespace XYO\SDK;

use Exception;
use GuzzleHttp;

class ClientException extends Exception
{
    public function __construct(string $msg, int $code = 0, Exception $previous = null)
    {
        parent::__construct($msg);
    }

    /**
     * It creates an instance of ClientException from HTTP Status Code
     */
    public static function ExceptionFromHttpStatusCode(int $code, string $content): self
    {
        if ($code > 400 && $code < 500) {
            $errorResponse = GuzzleHttp\json_decode($content, true);

            return new self(json_encode($errorResponse['errors']), $code);
        }

        return new self($content, $code);
    }
}
