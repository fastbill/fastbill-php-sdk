<?php
declare(strict_types=1);

namespace FastBillSdkTest\Api;

use FastBillSdk\Api\ApiClient;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;

/**
 * @TODO add test with valid credentials
 */
class ApiClientTest extends TestCase
{
    public function testPost(): void
    {
        $client = new ApiClient(
            'username',
            'apiKey'
        );

        $this->expectException(ClientException::class);

        $client->post('');
    }
}
