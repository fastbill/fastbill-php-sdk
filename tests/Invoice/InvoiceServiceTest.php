<?php declare(strict_types=1);

namespace FastBillSdkTest\Invoice;

use FastBillSdk\Invoice\InvoiceEntity;
use FastBillSdk\Invoice\InvoiceSearchStruct;
use FastBillSdk\Invoice\InvoiceService;
use FastBillSdk\Invoice\InvoiceValidator;
use FastBillSdk\Item\ItemValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

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
}
