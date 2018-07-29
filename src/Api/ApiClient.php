<?php declare(strict_types=1);

namespace FastBillSdk\Api;

use FastBillSdk\Common\ApiClientInterface;
use GuzzleHttp\Client;

class ApiClient implements ApiClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @param string $username
     * @param string $apiKey
     * @param string $endpoint
     */
    public function __construct(
        string $username,
        string $apiKey,
        string $endpoint = 'https://my.fastbill.com/api/1.0/api.php'
    ) {
        $this->client = new Client();
        $this->endpoint = $endpoint;
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $body): \Psr\Http\Message\ResponseInterface
    {
        $options = $this->getDefaultOptions();
        $options['body'] = $body;

        return $this->client->get($this->endpoint, $options);
    }

    /**
     * @param string $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $body): \Psr\Http\Message\ResponseInterface
    {
        $options = $this->getDefaultOptions();
        $options['body'] = $body;

        return $this->client->post($this->endpoint, $options);
    }

    /**
     * @param string $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put(string $body): \Psr\Http\Message\ResponseInterface
    {
        $options = $this->getDefaultOptions();
        $options['body'] = $body;

        return $this->client->put($this->endpoint, $options);
    }

    /**
     * @param string $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(string $body): \Psr\Http\Message\ResponseInterface
    {
        $options = $this->getDefaultOptions();
        $options['body'] = $body;

        return $this->client->put($this->endpoint, $options);
    }

    /**
     * @return array
     */
    private function getDefaultOptions(): array
    {
        return [
            'auth' => [
                $this->username,
                $this->apiKey,
            ],
            'headers' => [
                'Content-Type' => 'application/xml',
            ],
            'body' => '',
        ];
    }
}
