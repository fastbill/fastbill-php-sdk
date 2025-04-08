<?php
declare(strict_types=1);

namespace FastBillSdkTest\Helper;

use FastBillSdk\Api\ApiClientInterface;
use Psr\Http\Message\ResponseInterface;

class ApiDummyClient implements ApiClientInterface
{
    public $body;

    public $responseXml;

    public function post(string $body): ResponseInterface
    {
        $this->body = $body;

        return new ApiDummyResponse((string) $this->responseXml);
    }
}
