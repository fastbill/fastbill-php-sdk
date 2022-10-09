<?php
declare(strict_types=1);

namespace FastBillSdk\Invoice;

class InvoiceCommentEntity
{
    public $date;

    public $comment;

    public $commentPublic;

    public const FIELD_MAPPING = [
        'DATE' => 'date',
        'COMMENT' => 'comment',
        'COMMENT_PUBLIC' => 'commentPublic',
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
}
