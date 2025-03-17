<?php
declare(strict_types=1);

namespace FastBillSdk\Estimate;

class EstimateItemEntity
{
    public $estimateItemId;

    public $articleNumber;

    public $description;

    public $quantity;

    public $unit;

    public $unitPrice;

    public $vatPercent;

    public $vatValue;

    public $completeNet;

    public $completeGross;

    public $isGross;

    public $sortOrder;

    public const FIELD_MAPPING = [
        'ESTIMATE_ITEM_ID' => 'estimateItemId',
        'ARTICLE_NUMBER' => 'articleNumber',
        'DESCRIPTION' => 'description',
        'QUANTITY' => 'quantity',
        'UNIT' => 'unit',
        'UNIT_PRICE' => 'unitPrice',
        'VAT_PERCENT' => 'vatPercent',
        'VAT_VALUE' => 'vatValue',
        'COMPLETE_NET' => 'completeNet',
        'COMPLETE_GROSS' => 'completeGross',
        'IS_GROSS' => 'isGross',
        'SORT_ORDER' => 'sortOrder',
    ];

    public const XML_FIELD_MAPPING = [
        'estimateItemId' => 'ESTIMATE_ITEM_ID',
        'articleNumber' => 'ARTICLE_NUMBER',
        'description' => 'DESCRIPTION',
        'quantity' => 'QUANTITY',
        'unit' => 'UNIT',
        'unitPrice' => 'UNIT_PRICE',
        'vatPercent' => 'VAT_PERCENT',
        'vatValue' => 'VAT_VALUE',
        'completeNet' => 'COMPLETE_NET',
        'completeGross' => 'COMPLETE_GROSS',
        'isGross' => 'IS_GROSS',
        'sortOrder' => 'SORT_ORDER',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

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
            if ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
