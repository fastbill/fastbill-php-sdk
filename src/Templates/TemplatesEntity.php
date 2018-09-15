<?php declare(strict_types=1);

namespace FastBillSdk\Templates;

class TemplatesEntity
{
    public $templateId;

    public $templateName;

    public $templateHash;

    const FIELD_MAPPING = [
        'TEMPLATE_ID' => 'templateId',
        'TEMPLATE_NAME' => 'templateName',
        'TEMPLATE_HASH' => 'templateHash',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @param \SimpleXMLElement $data
     * @return TemplatesEntity
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
