<?php
declare(strict_types=1);

namespace FastBillSdkTest\WorkTime;

use FastBillSdk\WorkTime\WorkTimeSearchStruct;
use PHPUnit\Framework\TestCase;

class WorkTimeSearchStructTest extends TestCase
{
    public function testCompleteSearchStruct()
    {
        $searchStruct = new WorkTimeSearchStruct();

        $searchStruct->setCustomerIdFilter(1);
        $searchStruct->setProjectIdFilter(2);
        $searchStruct->setTaskIdFilter(3);
        $searchStruct->setTimeIdFilter(4);
        $searchStruct->setStartDateFilter(new \DateTime());
        $searchStruct->setEndDateFilter(new \DateTime());
        $searchStruct->setDateFilter(new \DateTime());

        $filters = $searchStruct->getFilters();

        self::assertEquals(1, $filters['CUSTOMER_ID']);
        self::assertEquals(2, $filters['PROJECT_ID']);
        self::assertEquals(3, $filters['TASK_ID']);
        self::assertEquals(4, $filters['TIME_ID']);

        self::assertInstanceOf(\DateTime::class, $filters['START_DATE']);
        self::assertInstanceOf(\DateTime::class, $filters['END_DATE']);
        self::assertInstanceOf(\DateTime::class, $filters['DATE']);
    }
}
