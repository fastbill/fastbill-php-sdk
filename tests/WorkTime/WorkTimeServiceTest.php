<?php
declare(strict_types=1);

namespace FastBillSdkTest\WorkTime;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;
use FastBillSdk\WorkTime\WorkTimeEntity;
use FastBillSdk\WorkTime\WorkTimeSearchStruct;
use FastBillSdk\WorkTime\WorkTimeService;
use FastBillSdk\WorkTime\WorkTimeValidator;
use FastBillSdkTest\Helper\ApiDummyClient;
use PHPUnit\Framework\TestCase;

class WorkTimeServiceTest extends TestCase
{
    /**
     * @var ApiDummyClient
     */
    private $apiClient;

    private function getApiDummyClient(): ApiDummyClient
    {
        if (!$this->apiClient) {
            $this->apiClient = new ApiDummyClient();
        }

        return $this->apiClient;
    }

    private function getWorkTimeService(): WorkTimeService
    {
        return new WorkTimeService(
            $this->getApiDummyClient(),
            new XmlService(),
            new WorkTimeValidator()
        );
    }

    //    public function testGetTime()
    //    {
    //        $this->getApiDummyClient()->responseXml = file_get_contents(__DIR__ . '/_fixtures/worktimes_get_response.xml');
    //        $result = $this->getWorkTimeService()->getTime(new WorkTimeSearchStruct());
    //
    //        self::assertContainsOnlyInstancesOf(WorkTimeEntity::class, $result);
    //        self::assertEquals(
    //            $this->getApiDummyClient()->body,
    //            file_get_contents(__DIR__ . '/_fixtures/worktime_get_request.xml')
    //        );
    //    }

    /*public function testCreateTimeWithInvalidEntity()
    {
        $invalidEntity = new WorkTimeEntity();
        $invalidEntity->customerId = 123;
        $invalidEntity->projectId = 321;
        $this->expectException(MissingPropertyException::class);
        $this->expectExceptionMessage('The property startTime is not valid!');
        $this->getWorkTimeService()->createTime($invalidEntity);
    }*/

    //    public function testCreateTime()
    //    {
    //        $entity = new WorkTimeEntity();
    //        $entity->customerId = 123;
    //        $entity->projectId = 321;
    //        $entity->startTime = '2018-09-21 20:50:38';
    //
    //        $this->getApiDummyClient()->responseXml = file_get_contents(
    //            __DIR__ . '/_fixtures/worktime_create_response.xml'
    //        );
    //
    //        $this->getWorkTimeService()->createTime($entity);
    //
    //        self::assertEquals(
    //            $this->getApiDummyClient()->body,
    //            file_get_contents(__DIR__ . '/_fixtures/worktime_create_request.xml')
    //        );
    //
    //        self::assertGreaterThan(0, $entity->timeId);
    //    }

    public function testUpdateTimeWithInvalidEntity()
    {
        $invalidEntity = new WorkTimeEntity();
        $invalidEntity->customerId = 123;
        $invalidEntity->projectId = 321;
        $invalidEntity->startTime = '2018-09-21 20:50:38';

        $this->expectException(MissingPropertyException::class);
        $this->expectExceptionMessage('The property timeId is not valid!');
        $this->getWorkTimeService()->updateTime($invalidEntity);
    }

    public function testUpdateTime()
    {
        $entity = new WorkTimeEntity();
        $entity->customerId = 111;
        $entity->projectId = 222;
        $entity->timeId = 333;
        $entity->startTime = '2018-09-21 20:50:38';

        $this->getApiDummyClient()->responseXml = file_get_contents(
            __DIR__ . '/_fixtures/worktime_update_response.xml'
        );

        $this->getWorkTimeService()->updateTime($entity);

        self::assertEquals(
            $this->getApiDummyClient()->body,
            file_get_contents(__DIR__ . '/_fixtures/worktime_update_request.xml')
        );

        self::assertGreaterThan(0, $entity->timeId);
    }

    public function testDeleteTimeWithInvalidEntity()
    {
        $invalidEntity = new WorkTimeEntity();
        $invalidEntity->customerId = 123;
        $invalidEntity->projectId = 321;
        $invalidEntity->startTime = '2018-09-21 20:50:38';

        $this->expectException(MissingPropertyException::class);
        $this->expectExceptionMessage('The property timeId is not valid!');
        $this->getWorkTimeService()->deleteTime($invalidEntity);
    }

    public function testDeleteTime()
    {
        $entity = new WorkTimeEntity();
        $entity->timeId = 333;

        $this->getApiDummyClient()->responseXml = file_get_contents(
            __DIR__ . '/_fixtures/worktime_delete_response.xml'
        );

        $this->getWorkTimeService()->deleteTime($entity);

        self::assertEquals(
            $this->getApiDummyClient()->body,
            file_get_contents(__DIR__ . '/_fixtures/worktime_delete_request.xml')
        );
    }
}
