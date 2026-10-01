<?php
declare(strict_types=1);

namespace FastBillSdk\Revenue;

use FastBillSdk\Common\AbstractSearchStruct;

class RevenueSearchStruct extends AbstractSearchStruct
{
    public function setInvoiceIdFilter(int $invoiceId)
    {
        $this->filters['INVOICE_ID'] = $invoiceId;
    }

    public function setInvoiceNumberFilter(string $invoiceNumber)
    {
        $this->filters['INVOICE_NUMBER'] = $invoiceNumber;
    }

    public function setTypeFilter(string $type)
    {
        $this->filters['TYPE'] = $type;
    }

    public function setSubTypeFilter(string $subType)
    {
        $this->filters['SUBTYPE'] = $subType;
    }

    public function setCustomerIdFilter(int $customerId)
    {
        $this->filters['CUSTOMER_ID'] = $customerId;
    }

    public function setCustomerNumberFilter(string $customerNumber)
    {
        $this->filters['CUSTOMER_NUMBER'] = $customerNumber;
    }

    public function setProjectIdFilter(int $projectId)
    {
        $this->filters['PROJECT_ID'] = $projectId;
    }

    public function setCurrencyCodeFilter(string $currencyCode)
    {
        $this->filters['CURRENCY_CODE'] = $currencyCode;
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
