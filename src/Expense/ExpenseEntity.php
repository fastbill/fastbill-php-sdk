<?php declare(strict_types=1);

namespace FastBillSdk\Expense;

class ExpenseEntity
{
    public $invoiceId;

    const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceID',
        'ORGANIZATION' => 'organization',
        'INVOICE_NUMBER' => 'invoiceNumber',
        'INVOICE_DATE' => 'invoiceDate',
        'DUE_DATE' => 'dueDate',
        'PROJECT_ID' => 'projectId',
        'CUSTOMER_ID' => 'customerId',
        'SUB_TOTAL' => 'subTotal',
        'VAT_TOTAL' => 'vatTotal',
        'TOTAL' => 'total',
        'PAID_DATE' => 'paidDate',
        'CURRENCY_CODE' => 'currencyCode',
        'COMMENT' => 'comment',
        'VAT_ITEMS' => 'vatItems',
        'PAYMENT_INFO' => 'paymentInfo',
        'DOCUMENT_URL' => 'documentUrl',
    ];

    const XML_FIELD_MAPPING = [
        'invoiceID' => 'INVOICE_ID',
        'organization' => 'ORGANIZATION',
        'invoiceNumber' => 'INVOICE_NUMBER',
        'invoiceDate' => 'INVOICE_DATE',
        'dueDate' => 'DUE_DATE',
        'projectId' => 'PROJECT_ID',
        'customerId' => 'CUSTOMER_ID',
        'subTotal' => 'SUB_TOTAL',
        'vatTotal' => 'VAT_TOTAL',
        'total' => 'TOTAL',
        'paidDate' => 'PAID_DATE',
        'currencyCode' => 'CURRENCY_CODE',
        'comment' => 'COMMENT',
        'vatItems' => 'VAT_ITEMS',
        'paymentInfo' => 'PAYMENT_INFO',
        'documentUrl' => 'DOCUMENT_URL',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return ExpenseEntity
     */
    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                trigger_error('the provided xml key ' . $key . ' is not mapped at the moment in ' . self::class);
                continue;
            }

            $this->{self::FIELD_MAPPING[$key]} = (string) $value;
        }

        return $this;
    }
}
