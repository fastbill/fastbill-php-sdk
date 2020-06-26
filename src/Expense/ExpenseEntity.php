<?php declare(strict_types=1);

namespace FastBillSdk\Expense;

class ExpenseEntity
{
    public $invoiceId;

    public $organization;

    public $invoiceNumber;

    public $invoiceDate;

    public $dueDate;

    public $projectId;

    public $customerId;

    public $subTotal;

    public $vatTotal;

    public $total;

    public $paidDate;

    public $currencyCode;

    public $category;

    public $comments;

    public $note;

    public $vatItems;

    public $items;

    public $paymentInfo;

    public $documentUrl;

    public $servicePeriodStart;

    public $servicePeriodEnd;

    const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceId',
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
        'CATEGORY' => 'category',
        'COMMENTS' => 'comments',
        'NOTE' => 'note',
        'VAT_ITEMS' => 'vatItems',
        'ITEMS' => 'items',
        'PAYMENT_INFO' => 'paymentInfo',
        'DOCUMENT_URL' => 'documentUrl',
        'SERVICE_PERIOD_START' => 'servicePeriodStart',
        'SERVICE_PERIOD_END' => 'servicePeriodEnd',
    ];

    const XML_FIELD_MAPPING = [
        'invoiceId' => 'INVOICE_ID',
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
        'category' => 'CATEGORY',
        'comments' => 'COMMENTS',
        'note' => 'NOTE',
        'vatItems' => 'VAT_ITEMS',
        'items' => 'ITEMS',
        'paymentInfo' => 'PAYMENT_INFO',
        'documentUrl' => 'DOCUMENT_URL',
        'servicePeriodStart' => 'SERVICE_PERIOD_START',
        'servicePeriodEnd' => 'SERVICE_PERIOD_END',
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

    public function getXmlData(): array
    {
        $xmlData = [];
        foreach (self::XML_FIELD_MAPPING as $key => $value) {
            if ($this->$key && $key === 'items') {
                foreach ($this->items as $item) {
                    $xmlData[$value][] = $item->getXmlData();
                }
            } elseif ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
