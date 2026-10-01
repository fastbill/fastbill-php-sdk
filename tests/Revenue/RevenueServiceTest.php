<?php
declare(strict_types=1);

namespace FastBillSdkTest\Revenue;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Revenue\RevenueEntity;
use FastBillSdk\Revenue\RevenueSearchStruct;
use FastBillSdk\Revenue\RevenueService;
use FastBillSdk\Revenue\RevenueValidator;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class RevenueServiceTest extends TestCase
{
    /**
     * @var ApiClientInterface&object{body: ?string, responseXml: ?string}
     */
    private $client;

    protected function setUp(): void
    {
        $this->client = new class implements ApiClientInterface {
            public $body;

            public $responseXml;

            public function post(string $body): ResponseInterface
            {
                $this->body = $body;

                return new Response(200, [], (string) $this->responseXml);
            }
        };
    }

    private function getService(): RevenueService
    {
        return new RevenueService($this->client, new XmlService(), new RevenueValidator());
    }

    public function testGetRevenueParsesResponse()
    {
        $this->client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><REVENUES><REVENUE>'
            . '<INVOICE_ID>12</INVOICE_ID><TOTAL>119.00</TOTAL><EXCHANGE_RATE>1.1</EXCHANGE_RATE>'
            . '<ITEMS><ITEM><DESCRIPTION>Foo</DESCRIPTION></ITEM></ITEMS>'
            . '</REVENUE></REVENUES></RESPONSE></FBAPI>';

        $searchStruct = new RevenueSearchStruct();
        $searchStruct->setCustomerIdFilter(5);
        $searchStruct->setTypeFilter('outgoing');

        $revenues = $this->getService()->getRevenue($searchStruct);

        self::assertStringContainsString('<SERVICE>revenue.get</SERVICE>', $this->client->body);
        self::assertStringContainsString('<CUSTOMER_ID>5</CUSTOMER_ID>', $this->client->body);
        self::assertStringContainsString('<TYPE>outgoing</TYPE>', $this->client->body);
        self::assertCount(1, $revenues);
        self::assertSame('12', $revenues[0]->invoiceId);
        self::assertSame('1.1', $revenues[0]->exchangeRate);
        self::assertInstanceOf(ItemEntity::class, $revenues[0]->items[0]);
        self::assertSame('Foo', $revenues[0]->items[0]->description);
    }

    public function testCreateRevenue()
    {
        $this->client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS><INVOICE_ID>99</INVOICE_ID></RESPONSE></FBAPI>';

        $entity = new RevenueEntity();
        $entity->invoiceDate = '2026-01-01';
        $entity->customerId = 5;
        $entity->subTotal = 100;

        $result = $this->getService()->createRevenue($entity);

        self::assertStringContainsString('<SERVICE>revenue.create</SERVICE>', $this->client->body);
        self::assertStringContainsString('<SUB_TOTAL>100</SUB_TOTAL>', $this->client->body);
        self::assertSame('99', $result->invoiceId);
    }

    public function testCreateRevenueWithEmptyEntity()
    {
        $this->expectException(MissingPropertyException::class);
        $this->getService()->createRevenue(new RevenueEntity());
    }

    public function testSetPaidRevenue()
    {
        $this->client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS><INVOICE_NUMBER>R-1</INVOICE_NUMBER></RESPONSE></FBAPI>';

        $entity = new RevenueEntity();
        $entity->invoiceId = 99;
        $entity->paidDate = '2026-02-01';

        $result = $this->getService()->setPaidRevenue($entity);

        self::assertStringContainsString('<SERVICE>revenue.setpaid</SERVICE>', $this->client->body);
        self::assertStringContainsString('<PAID_DATE>2026-02-01</PAID_DATE>', $this->client->body);
        self::assertSame('R-1', $result->invoiceNumber);
    }

    public function testSetPaidRevenueWithEmptyEntity()
    {
        $this->expectException(MissingPropertyException::class);
        $this->getService()->setPaidRevenue(new RevenueEntity());
    }

    public function testDeleteRevenue()
    {
        $this->client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS></RESPONSE></FBAPI>';

        $entity = new RevenueEntity();
        $entity->invoiceId = 99;

        $result = $this->getService()->deleteRevenue($entity);

        self::assertStringContainsString('<SERVICE>revenue.delete</SERVICE>', $this->client->body);
        self::assertStringContainsString('<INVOICE_ID>99</INVOICE_ID>', $this->client->body);
        self::assertNull($result->invoiceId);
    }

    public function testDeleteRevenueWithEmptyEntity()
    {
        $this->expectException(MissingPropertyException::class);
        $this->getService()->deleteRevenue(new RevenueEntity());
    }
}
