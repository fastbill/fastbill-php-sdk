<?php
declare(strict_types=1);

namespace FastBillSdkTest\Estimate;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Estimate\EstimateEntity;
use FastBillSdk\Estimate\EstimateItemEntity;
use FastBillSdk\Estimate\EstimateItemValidator;
use FastBillSdk\Estimate\EstimateSearchStruct;
use FastBillSdk\Estimate\EstimateService;
use FastBillSdk\Estimate\EstimateValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class EstimateServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var EstimateService
     */
    private $estimateService;

    public function getEstimateService(): EstimateService
    {
        if (!$this->estimateService) {
            $this->estimateService = new EstimateService(
                $this->getApiClient(),
                $this->getXmlService(),
                new EstimateValidator(new EstimateItemValidator())
            );
        }

        return $this->estimateService;
    }

    public function getEstimateServiceWithApiDummy(): EstimateService
    {
        if (!$this->estimateService) {
            $this->estimateService = new EstimateService(
                $this->getApiDummyClient(),
                $this->getXmlService(),
                new EstimateValidator(new EstimateItemValidator())
            );
        }

        return $this->estimateService;
    }

    public function testGetEstimates()
    {
        $estimates = $this->getEstimateService()->getEstimate(new EstimateSearchStruct());
        foreach ($estimates as $estimate) {
            self::assertInstanceOf(EstimateEntity::class, $estimate);
        }
    }

    public function testGetEstimatesWithFilter()
    {
        $searchStruct = new EstimateSearchStruct();
        $searchStruct->setCustomerIdFilter(111);
        $searchStruct->setEndEstimateDate('01.01.2030');
        $searchStruct->setEstimateId(123);
        $searchStruct->setEstimateNumber('EST-123');
        $searchStruct->setStartEstimateDate('01.01.2018');

        $estimates = $this->getEstimateService()->getEstimate($searchStruct);

        self::assertCount(0, $estimates);
    }

    public function testCreateEstimateWithEmptyEntity()
    {
        $estimate = new EstimateEntity();
        $estimate->items = [new \stdClass()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->createEstimate($estimate);
    }

    public function testCreateEstimateWithEmptyItemEntity()
    {
        $estimate = new EstimateEntity();
        $estimate->items = [new EstimateItemEntity()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->createEstimate($estimate);
    }

    public function testDeleteEstimateWithEmptyEntity()
    {
        $estimate = new EstimateEntity();
        $estimate->items = [new \stdClass()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->deleteEstimate($estimate);
    }

    public function testUpdateEstimate()
    {
        $client = $this->getApiDummyClient();
        $client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS><ESTIMATE_ID>123</ESTIMATE_ID></RESPONSE></FBAPI>';
        $service = new EstimateService($client, $this->getXmlService(), new EstimateValidator(new EstimateItemValidator()));

        $item = new EstimateItemEntity();
        $item->estimateItemId = 7;
        $item->description = 'FastBill SDK';
        $item->unitPrice = 1337;
        $item->vatPercent = 19;

        $estimate = new EstimateEntity();
        $estimate->estimateId = 123;
        $estimate->state = 'accepted';
        $estimate->dueDate = '2026-12-31';
        $estimate->items = [$item];

        $service->updateEstimate($estimate);

        self::assertStringContainsString('<SERVICE>estimate.update</SERVICE>', $client->body);
        self::assertStringContainsString('<ESTIMATE_ID>123</ESTIMATE_ID>', $client->body);
        self::assertStringContainsString('<STATE>accepted</STATE>', $client->body);
        self::assertStringContainsString('<DUE_DATE>2026-12-31</DUE_DATE>', $client->body);
        self::assertStringContainsString('<ESTIMATE_ITEM_ID>7</ESTIMATE_ITEM_ID>', $client->body);
        self::assertStringNotContainsString('DELETE_EXISTING_ITEMS', $client->body);
    }

    public function testUpdateEstimateStateOnlyWithDeleteExistingItems()
    {
        $client = $this->getApiDummyClient();
        $client->responseXml = '<?xml version="1.0"?><FBAPI><RESPONSE><STATUS>success</STATUS><ESTIMATE_ID>123</ESTIMATE_ID></RESPONSE></FBAPI>';
        $service = new EstimateService($client, $this->getXmlService(), new EstimateValidator(new EstimateItemValidator()));

        $estimate = new EstimateEntity();
        $estimate->estimateId = 123;
        $estimate->state = 'sent';

        $service->updateEstimate($estimate, true);

        self::assertStringContainsString('<DELETE_EXISTING_ITEMS>1</DELETE_EXISTING_ITEMS>', $client->body);
        self::assertStringContainsString('<STATE>sent</STATE>', $client->body);
    }

    public function testUpdateEstimateWithEmptyEntity()
    {
        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->updateEstimate(new EstimateEntity());
    }

    public function testUpdateEstimateWithInvalidItem()
    {
        $estimate = new EstimateEntity();
        $estimate->estimateId = 123;
        $estimate->items = [new EstimateItemEntity()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->updateEstimate($estimate);
    }
}
