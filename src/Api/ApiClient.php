<?php
declare(strict_types=1);

namespace FastBillSdk\Api;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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

    public function post(string $body): ResponseInterface
    {
        $options = $this->getDefaultOptions();
        $options['body'] = $body;

        return $this->client->post($this->endpoint, $options);
    }

    /**
     * @internal
     */
    protected function getDefaultOptions(): array
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
