<?php declare(strict_types=1);

namespace FastBillSdk\Api;

interface ApiClientInterface
{
    public function post(string $body): \Psr\Http\Message\ResponseInterface;
}
