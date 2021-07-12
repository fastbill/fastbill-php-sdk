<?php
declare(strict_types=1);

namespace FastBillSdk\ExpenseItem;

use FastBillSdk\Item\VatItemEntity;

class ExpenseItemEntity
{
    public $invoiceItemId;

    public $invoiceId;

    public $customerId;

    public $category;

    public $articleNumber;

    public $description;

    public $quantity;

    public $unitPrice;

    public $vatPercent;

    public $vatValue;

    public $netValue;

    public $completeNet;

    public $completeGross;

    public $currencyCode;

    public $sortOrder;

    const FIELD_MAPPING = [
        'INVOICE_ITEM_ID' => 'invoiceItemId',
        'INVOICE_ID' => 'invoiceId',
        'CUSTOMER_ID' => 'customerId',
        'CATEGORY' => 'category',
        'ARTICLE_NUMBER' => 'articleNumber',
        'DESCRIPTION' => 'description',
        'QUANTITY' => 'quantity',
        'UNIT_PRICE' => 'unitPrice',
        'VAT_PERCENT' => 'vatPercent',
        'VAT_VALUE' => 'vatValue',
        'NET_VALUE' => 'netValue',
        'COMPLETE_NET' => 'completeNet',
        'COMPLETE_GROSS' => 'completeGross',
        'CURRENCY_CODE' => 'currencyCode',
        'SORT_ORDER' => 'sortOrder',
    ];

    const XML_FIELD_MAPPING = [
        'invoiceItemId' => 'INVOICE_ITEM_ID',
        'invoiceId' => 'INVOICE_ID',
        'customerId' => 'CUSTOMER_ID',
        'category' => 'CATEGORY',
        'articleNumber' => 'ARTICLE_NUMBER',
        'description' => 'DESCRIPTION',
        'quantity' => 'QUANTITY',
        'unitPrice' => 'UNIT_PRICE',
        'vatPercent' => 'VAT_PERCENT',
        'vatValue' => 'VAT_VALUE',
        'netValue' => 'NET_VALUE',
        'completeNet' => 'COMPLETE_NET',
        'completeGross' => 'COMPLETE_GROSS',
        'currencyCode' => 'CURRENCY_CODE',
        'sortOrder' => 'SORT_ORDER',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return ExpenseItemEntity
     */
    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                trigger_error('the provided xml key ' . $key . ' is not mapped at the moment in ' . self::class);
                continue;
            }

            switch ($key) {
                case 'ITEMS':
                    $items = [];
                    foreach ($value as $item) {
                        $items[] = new ExpenseItemEntity($item);
                    }

                    $this->{self::FIELD_MAPPING[$key]} = $items;
                    break;
                case 'VAT_ITEMS':
                    $vatItems = [];
                    foreach ($value as $vatItem) {
                        $vatItems[] = new VatItemEntity($vatItem);
                    }

                    $this->{self::FIELD_MAPPING[$key]} = $vatItems;
                    break;
                default:
                    $this->{self::FIELD_MAPPING[$key]} = (string) $value;
                    break;
            }
        }

        return $this;
    }

    public function getXmlData(): array
    {
        $xmlData = [];
        foreach (self::XML_FIELD_MAPPING as $key => $value) {
            if ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
