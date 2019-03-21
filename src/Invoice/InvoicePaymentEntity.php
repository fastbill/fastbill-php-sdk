<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

class InvoicePaymentEntity
{
    public $paymentId;

    public $date;

    public $amount;

    public $currency;

    public $currencyCode;

    public $type;

    public $note;

    const FIELD_MAPPING = [
        'PAYMENT_ID' => 'paymentId',
        'DATE' => 'date',
        'AMOUNT' => 'amount',
        'CURRENCY' => 'currency',
        'CURRENCY_CODE' => 'currencyCode',
        'TYPE' => 'type',
        'NOTE' => 'note',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return InvoicePaymentEntity
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
