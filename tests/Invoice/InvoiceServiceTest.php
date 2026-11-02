<?php
declare(strict_types=1);

namespace FastBillSdkTest\Invoice;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Invoice\InvoiceEntity;
use FastBillSdk\Invoice\InvoiceSearchStruct;
use FastBillSdk\Invoice\InvoiceService;
use FastBillSdk\Invoice\InvoiceValidator;
use FastBillSdk\Item\ItemValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use FastBillSdkTest\Helper\ApiDummyClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class InvoiceServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var InvoiceService
     */
    private $invoiceService;

    public function getInvoiceService(): InvoiceService
    {
        if (!$this->invoiceService) {
            $this->invoiceService = new InvoiceService(
                $this->getApiClient(),
                $this->getXmlService(),
                new InvoiceValidator(new ItemValidator())
            );
        }

        return $this->invoiceService;
    }

    public function testGetInvoice()
    {
        foreach ($this->getInvoiceService()->getInvoice(new InvoiceSearchStruct()) as $invoice) {
            self::assertInstanceOf(InvoiceEntity::class, $invoice);
        }
    }

    public function testPartialCancelInvoice()
    {
        $client = new class implements ApiClientInterface {
            public $body;

            public $responseXml;

            public function post(string $body): ResponseInterface
            {
                $this->body = $body;

                return new Response(200, [], (string) $this->responseXml);
            }
        };
        $client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS><INVOICE_ID>99</INVOICE_ID></RESPONSE></FBAPI>';
        $service = new InvoiceService($client, $this->getXmlService(), new InvoiceValidator(new ItemValidator()));

        $invoice = new InvoiceEntity();
        $invoice->invoiceId = 12;

        $cancellationInvoiceId = $service->partialCancelInvoice($invoice, 'Gutschrift', 50.5, 19);

        self::assertStringContainsString('<SERVICE>invoice.cancel</SERVICE>', $client->body);
        self::assertStringContainsString('<INVOICE_ID>12</INVOICE_ID>', $client->body);
        self::assertStringContainsString('<PARTIAL_CANCELLATION>1</PARTIAL_CANCELLATION>', $client->body);
        self::assertStringContainsString('<ITEM_TEXT>Gutschrift</ITEM_TEXT>', $client->body);
        self::assertStringContainsString('<NET_AMOUNT>50.5</NET_AMOUNT>', $client->body);
        self::assertStringContainsString('<VAT_PERCENT>19</VAT_PERCENT>', $client->body);
        self::assertSame(99, $cancellationInvoiceId);
    }

    public function testPartialCancelInvoiceWithEmptyEntity()
    {
        $service = new InvoiceService(new ApiDummyClient(), $this->getXmlService(), new InvoiceValidator(new ItemValidator()));

        $this->expectException(MissingPropertyException::class);
        $service->partialCancelInvoice(new InvoiceEntity(), 'Gutschrift', 50.5, 19);
    }
}
