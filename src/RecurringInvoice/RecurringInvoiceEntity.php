<?php declare(strict_types=1);

namespace FastBillSdk\RecurringInvoice;

class RecurringInvoiceEntity
{
    public $invoiceId;

    public $type;

    public $customerId;

    public $customerCostcenterId;

    public $currencyCode;

    public $templateId;

    public $introtext;

    public $startDate;

    public $frequency;

    public $occurences;

    public $outputType;

    public $emailNotify;

    public $invoiceNumber;

    public $paidDate;

    public $isCanceled;

    public $invoiceDate;

    public $dueDate;

    public $deliveryDate;

    public $cashDiscountPercent;

    public $cashDiscountDays;

    public $subTotal;

    public $vatTotal;

    public $total;

    public $vatItems;

    public $vatCase;

    public $templateHash;

    public $items;

    public $deleteExistingItems = 1;

    const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceId',
        'TYPE' => 'type',
        'CUSTOMER_ID' => 'customerId',
        'CUSTOMER_COSTCENTER_ID' => 'customerCostcenterId',
        'CURRENCY_CODE' => 'currencyCode',
        'TEMPLATE_ID' => 'templateId',
        'INTROTEXT' => 'introtext',
        'INVOICE_NUMBER' => 'invoiceNumber',
        'PAID_DATE' => 'paidDate',
        'IS_CANCELED' => 'isCanceled',
        'INVOICE_DATE' => 'invoiceDate',
        'DUE_DATE' => 'dueDate',
        'DELIVERY_DATE' => 'deliveryDate',
        'CASH_DISCOUNT_PERCENT' => 'cashDiscountPercent',
        'CASH_DISCOUNT_DAYS' => 'cashDiscountDays',
        'SUB_TOTAL' => 'subTotal',
        'VAT_TOTAL' => 'vatTotal',
        'TOTAL' => 'total',
        'VAT_ITEMS' => 'vatItems',
        'ITEMS' => 'items',
    ];

    const XML_FIELD_MAPPING = [
        'customerId' => 'CUSTOMER_ID',
        'customerCostcenterId' => 'CUSTOMER_COSTCENTER_ID',
        'currencyCode' => 'CURRENCY_CODE',
        'templateId' => 'TEMPLATE_ID',
        'introtext' => 'INTROTEXT',
        'startDate' => 'START_DATE',
        'frequency' => 'FREQUENCY',
        'occurences' => 'OCCURENCES',
        'outputType' => 'OUTPUT_TYPE',
        'emailNotify' => 'EMAIL_NOTIFY',
        'deliveryDate' => 'DELIVERY_DATE',
        'cashDiscountPercent' => 'CASH_DISCOUNT_PERCENT',
        'cashDiscountDays' => 'CASH_DISCOUNT_DAYS',
        'vatCase' => 'VAT_CASE',
        'templateHash' => 'TEMPLATE_HASH',
        'items' => 'ITEMS',
        'deleteExistingItems' => 'DELETE_EXISTING_ITEMS',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return RecurringInvoiceEntity
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
