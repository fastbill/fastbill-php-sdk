<?php declare(strict_types=1);

namespace FastBillSdk\Worktimes;

class WorktimesGetResult
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
        'BILLABLE_MINUTES' => 'billableMinutes',
        'COMMENT' => 'comment',
    ];

    /**
     * @param \SimpleXMLElement $data
     * @return WorktimesGetResult
     */
    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                continue;
            }

            $this->{self::FIELD_MAPPING[$key]} = (string) $value;
        }

        return $this;
    }
}
