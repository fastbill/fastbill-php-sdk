<?php declare(strict_types=1);

namespace FastBillSdk\Common;

interface ApiClientInterface
{
    public function get(string $body): \Psr\Http\Message\ResponseInterface;

    public function post(string $body): \Psr\Http\Message\ResponseInterface;

    public function put(string $body): \Psr\Http\Message\ResponseInterface;

    public function delete(string $body): \Psr\Http\Message\ResponseInterface;
}
