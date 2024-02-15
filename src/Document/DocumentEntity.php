<?php
declare(strict_types=1);

namespace FastBillSdk\Document;

class DocumentEntity
{
    public $documentId;

    public $type;

    public $title;

    public $date;

    public $note;

    public const FIELD_MAPPING = [
        'DOCUMENT_ID' => 'documentId',
        'TYPE' => 'type',
        'TITLE' => 'title',
        'DATE' => 'date',
        'NOTE' => 'note',
    ];

    public const XML_FIELD_MAPPING = [
        'documentId' => 'DOCUMENT_ID',
        'type' => 'TYPE',
        'title' => 'TITLE',
        'date' => 'DATE',
        'note' => 'NOTE',
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
}
