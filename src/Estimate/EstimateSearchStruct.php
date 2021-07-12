<?php
declare(strict_types=1);

namespace FastBillSdk\Estimate;

use FastBillSdk\Common\AbstractSearchStruct;

class EstimateSearchStruct extends AbstractSearchStruct
{
    public function setCustomerIdFilter(int $customerId)
    {
        $this->filters['CUSTOMER_ID'] = $customerId;
    }

    public function setEstimateId(int $estimateId)
    {
        $this->filters['ESTIMATE_ID'] = $estimateId;
    }

    public function setEstimateNumber(string $estimateNumber)
    {
        $this->filters['ESTIMATE_NUMBER'] = $estimateNumber;
    }

    public function setStartEstimateDate(string $startDate)
    {
        $this->filters['START_ESTIMATE_DATE'] = $startDate;
    }

    public function setEndEstimateDate(string $endDate)
    {
        $this->filters['END_ESTIMATE_DATE'] = $endDate;
    }
}
