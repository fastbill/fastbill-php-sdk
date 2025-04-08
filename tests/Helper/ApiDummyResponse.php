<?php

namespace FastBillSdkTest\Helper;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ApiDummyResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $responseXml;

    public function __construct(string $responseXml)
    {
        $this->responseXml = $responseXml;
    }

    public function getStatusCode(): int
    {
        return 0;
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        return $this;
    }

    public function getReasonPhrase(): string
    {
        return '';
    }

    public function getProtocolVersion(): string
    {
        return '';
    }

    public function withProtocolVersion($version): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function hasHeader($name): bool
    {
        return false;
    }

    public function getHeader($name): array
    {
        return [];
    }

    public function getHeaderLine($name): string
    {
        return '';
    }

    public function withHeader($name, $value): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }

    public function withAddedHeader($name, $value): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }

    public function withoutHeader($name): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }

    public function getBody(): StreamInterface
    {
        return $this->responseXml;
    }

    public function withBody(StreamInterface $body): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }
}
