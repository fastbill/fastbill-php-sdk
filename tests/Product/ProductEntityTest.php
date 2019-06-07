<?php declare(strict_types=1);

namespace FastBillSdkTest\Product;

use FastBillSdk\Product\ProductEntity;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \FastBillSdk\Product\ProductEntity
 */
class ProductEntityTest extends TestCase
{
    /**
     * @covers ::__construct()
     * @covers ::setData()
     */
    public function testSetData()
    {
        $entity = new ProductEntity(
            new \SimpleXMLElement(
                file_get_contents(__DIR__ . '/_fixtures/worktimes_entity.xml')
            )
        );

        self::assertEquals('112233', $entity->timeId);
        self::assertEquals('123', $entity->customerId);
        self::assertEquals('456', $entity->projectId);
        self::assertEquals('789', $entity->invoiceId);
        self::assertEquals('2018-06-25 22:47:34', $entity->date);
        self::assertEquals('2010-01-01 00:00:00', $entity->startTime);
        self::assertEquals('0000-00-00 00:00:00', $entity->endTime);
        self::assertEquals('30', $entity->minutes);
        self::assertEquals('30', $entity->billableMinutes);
        self::assertEquals('Make FastBill great again!', $entity->comment);
    }
}
