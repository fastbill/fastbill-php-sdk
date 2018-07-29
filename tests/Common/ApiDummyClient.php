<?php declare(strict_types=1);

namespace FastBillSdkTest\Common;

use FastBillSdk\Common\ApiClientInterface;

class ApiDummyClient implements ApiClientInterface
{
    public function get(string $body): \Psr\Http\Message\ResponseInterface
    {
        // TODO: Implement get() method.
    }

    public function post(string $body): \Psr\Http\Message\ResponseInterface
    {
        // TODO: Implement post() method.
    }

    public function put(string $body): \Psr\Http\Message\ResponseInterface
    {
        // TODO: Implement put() method.
    }

    public function delete(string $body): \Psr\Http\Message\ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}
