<?php
declare(strict_types=1);

namespace FastBillSdk\Project;

use FastBillSdk\Common\AbstractSearchStruct;

class ProjectSearchStruct extends AbstractSearchStruct
{
    public function setCustomerIdFilter(int $customerId)
    {
        $this->filters['CUSTOMER_ID'] = $customerId;
    }

    public function setProjectIdFilter(int $projectId)
    {
        $this->filters['PROJECT_ID'] = $projectId;
    }

    public function setProjectNumberFilter(string $projectNumber)
    {
        $this->filters['PROJECT_NUMBER'] = $projectNumber;
    }
}
