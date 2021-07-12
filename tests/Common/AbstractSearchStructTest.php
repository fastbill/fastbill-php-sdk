<?php
declare(strict_types=1);

namespace FastBillSdkTest\Common;

use PHPUnit\Framework\TestCase;

class AbstractSearchStructTest extends TestCase
{
    public function testLimit(): void
    {
        $searchStruct = new SearchStructImplementation();
        $searchStruct->setLimit(100);

        self::assertEquals(100, $searchStruct->getLimit());
    }

    public function testOffset(): void
    {
        $searchStruct = new SearchStructImplementation();
        $searchStruct->setOffset(100);

        self::assertEquals(100, $searchStruct->getOffset());
    }

    public function testFilters(): void
    {
        $searchStruct = new SearchStructImplementation();

        self::assertEquals([], $searchStruct->getFilters());
    }
}
