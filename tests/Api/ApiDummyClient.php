<?php declare(strict_types=1);

namespace FastBillSdkTest\Api;

use FastBillSdk\Api\ApiClientInterface;

class ApiDummyClient implements ApiClientInterface
{
    public $body;

    public $responseXml;

    public function post(string $body): \Psr\Http\Message\ResponseInterface
    {
        $this->body = $body;

        return new ApiDummyResponse($this->responseXml);
    }
}
