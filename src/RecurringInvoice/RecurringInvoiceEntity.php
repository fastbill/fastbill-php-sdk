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
}
