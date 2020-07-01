<?php declare(strict_types=1);

namespace FastBillSdk\Expense;

use FastBillSdk\Common\AbstractSearchStruct;

class ExpenseSearchStruct extends AbstractSearchStruct
{
    public function setInvoiceIdFilter(int $invoiceId)
    {
        $this->filters['INVOICE_ID'] = $invoiceId;
    }

    public function setInvoiceNumberFilter(string $invoiceNumber)
    {
        $this->filters['INVOICE_NUMBER'] = $invoiceNumber;
    }

    public function setMonthFilter(int $month)
    {
        $this->filters['MONTH'] = $month;
    }

    public function setYearFilter(int $year)
    {
        $this->filters['YEAR'] = $year;
    }
}
