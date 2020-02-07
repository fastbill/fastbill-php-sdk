<?php declare(strict_types=1);

namespace FastBillSdk\Product;

class ProductEntity
{
    public $articleId;

    public $articleNumber;

    public $title;

    public $description;

    public $unit;

    public $unitPrice;

    public $currencyCode;

    public $vatPercent;

    public $isGross;

    public $tags;

    public const FIELD_MAPPING = [
        'ARTICLE_ID' => 'articleId',
        'ARTICLE_NUMBER' => 'articleNumber',
        'TITLE' => 'title',
        'DESCRIPTION' => 'description',
        'UNIT' => 'unit',
        'UNIT_PRICE' => 'unitPrice',
        'CURRENCY_CODE' => 'currencyCode',
        'VAT_PERCENT' => 'vatPercent',
        'IS_GROSS' => 'isGross',
        'TAGS' => 'tags',
    ];

    public const XML_FIELD_MAPPING = [
        'articleId' => 'ARTICLE_ID',
        'articleNumber' => 'ARTICLE_NUMBER',
        'title' => 'TITLE',
        'description' => 'DESCRIPTION',
        'unit' => 'UNIT',
        'unitPrice' => 'UNIT_PRICE',
        'currencyCode' => 'CURRENCY_CODE',
        'vatPercent' => 'VAT_PERCENT',
        'isGross' => 'IS_GROSS',
        'tags' => 'TAGS',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return ProductEntity
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
            if ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
