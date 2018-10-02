<?php declare(strict_types=1);

namespace FastBillSdkTest\Api;

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

    public function getStatusCode()
    {
    }

    public function withStatus($code, $reasonPhrase = '')
    {
    }

    public function getReasonPhrase()
    {
    }

    public function getProtocolVersion()
    {
    }

    public function withProtocolVersion($version)
    {
    }

    public function getHeaders()
    {
    }

    public function hasHeader($name)
    {
    }

    public function getHeader($name)
    {
    }

    public function getHeaderLine($name)
    {
    }

    public function withHeader($name, $value)
    {
    }

    public function withAddedHeader($name, $value)
    {
    }

    public function withoutHeader($name)
    {
    }

    public function getBody()
    {
        return $this->responseXml;
    }

    public function withBody(StreamInterface $body)
    {
    }
}
