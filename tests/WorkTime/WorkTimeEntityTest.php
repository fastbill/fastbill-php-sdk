<?php declare(strict_types=1);

namespace FastBillSdkTest\WorkTime;

use FastBillSdk\WorkTime\WorkTimeEntity;
use FastBillSdkTest\Helper\EntityTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \FastBillSdk\WorkTime\WorkTimeEntity
 */
class WorkTimeEntityTest extends TestCase
{
    use EntityTestTrait;

    /**
     * @covers ::__construct()
     * @covers ::setData()
     */
    public function testSetData()
    {
        $entity = new WorkTimeEntity(
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

    /**
     * @covers ::__construct()
     * @covers ::setData()
     */
    public function testSetDataWithInvalidXml()
    {
        $this->disableDefaultErrorHandler();

        $entity = new WorkTimeEntity(
            new \SimpleXMLElement(
                file_get_contents(__DIR__ . '/_fixtures/worktimes_entity_with_invalid_properties.xml')
            )
        );

        self::assertEquals(
            'the provided xml key INVALID is not mapped at the moment in FastBillSdk\WorkTime\WorkTimeEntity',
            array_pop($this->noticeMessages)
        );

        $this->activateDefaultErrorHandler();
    }

    /**
     * @covers ::getXmlData()
     */
    public function testGetXmlData(): void
    {
        $entity = new WorkTimeEntity(
            new \SimpleXMLElement(
                file_get_contents(__DIR__ . '/_fixtures/worktimes_entity.xml')
            )
        );

        $checkArray = [
            'TIME_ID' => '112233',
            'CUSTOMER_ID' => '123',
            'PROJECT_ID' => '456',
            'INVOICE_ID' => '789',
            'DATE' => '2018-06-25 22:47:34',
            'START_TIME' => '2010-01-01 00:00:00',
            'END_TIME' => '0000-00-00 00:00:00',
            'MINUTES' => '30',
            'BILLABLE_MINUTES' => '30',
            'COMMENT' => 'Make FastBill great again!',
        ];

        self::assertEquals($entity->getXmlData(), $checkArray);
    }
}
