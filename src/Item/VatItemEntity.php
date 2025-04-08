<?php
declare(strict_types=1);

namespace FastBillSdk\Item;

class VatItemEntity
{
    public $vatPercent;

    public $completeNet;

    public $vatValue;

    public const FIELD_MAPPING = [
        'VAT_PERCENT' => 'vatPercent',
        'COMPLETE_NET' => 'completeNet',
        'VAT_VALUE' => 'vatValue',
    ];

    public const XML_FIELD_MAPPING = [
        'vatPercent' => 'VAT_PERCENT',
        'completeNet' => 'COMPLETE_NET',
        'vatValue' => 'VAT_VALUE',
    ];

    public function __construct(?\SimpleXMLElement $data = null)
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
