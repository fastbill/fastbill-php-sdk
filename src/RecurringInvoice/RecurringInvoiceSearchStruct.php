<?php
declare(strict_types=1);

namespace FastBillSdk\RecurringInvoice;

use FastBillSdk\Common\AbstractSearchStruct;

class RecurringInvoiceSearchStruct extends AbstractSearchStruct
{
    public function setInvoiceIdFilter(int $invoiceId)
    {
        $this->filters['INVOICE_ID'] = $invoiceId;
    }

    public function setIsGrossFilter(bool $isGross)
    {
        $this->filters['IS_GROSS'] = $isGross ? 1 : 0;
    }
}
