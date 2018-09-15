<?php declare(strict_types=1);

namespace FastBillSdk\Items;

class ItemsEntity
{
    public $invoiceItemId;

    public $invoiceId;

    public $customerId;

    public $articleNumber;

    public $description;

    public $quantity;

    public $unitPrice;

    public $vatPercent;

    public $vatValue;

    public $completeNet;

    public $completeGross;

    public $currencyCode;

    public $sortOrder;

    const FIELD_MAPPING = [
        'INVOICE_ITEM_ID' => 'invoiceItemId',
        'INVOICE_ID' => 'invoiceId',
        'CUSTOMER_ID' => 'customerId',
        'ARTICLE_NUMBER' => 'articleNumber',
        'DESCRIPTION' => 'description',
        'QUANTITY' => 'quantity',
        'UNIT_PRICE' => 'unitPrice',
        'VAT_PERCENT' => 'vatPercent',
        'VAT_VALUE' => 'vatValue',
        'COMPLETE_NET' => 'completeNet',
        'COMPLETE_GROSS' => 'completeGross',
        'CURRENCY_CODE' => 'currencyCode',
        'SORT_ORDER' => 'sortOrder',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @param \SimpleXMLElement $data
     * @return ItemsEntity
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
