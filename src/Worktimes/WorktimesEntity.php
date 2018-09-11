<?php declare(strict_types=1);

namespace FastBillSdk\Worktimes;

class WorktimesEntity
{
    public $timeId;

    public $customerId;

    public $projectId;

    public $invoiceId;

    public $date;

    public $startTime;

    public $endTime;

    public $minutes;

    public $billableMinutes;

    public $comment;

    const FIELD_MAPPING = [
        'TIME_ID' => 'timeId',
        'CUSTOMER_ID' => 'customerId',
        'PROJECT_ID' => 'projectId',
        'INVOICE_ID' => 'invoiceId',
        'DATE' => 'date',
        'START_TIME' => 'startTime',
        'END_TIME' => 'endTime',
        'MINUTES' => 'minutes',
        'BILLABLE_MINUTES' => 'billableMinutes',
        'COMMENT' => 'comment',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @param \SimpleXMLElement $data
     * @return WorktimesEntity
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
