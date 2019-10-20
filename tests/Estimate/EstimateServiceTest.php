<?php declare(strict_types=1);

namespace FastBillSdkTest\Estimate;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Estimate\EstimateEntity;
use FastBillSdk\Estimate\EstimateItemEntity;
use FastBillSdk\Estimate\EstimateItemValidator;
use FastBillSdk\Estimate\EstimateSearchStruct;
use FastBillSdk\Estimate\EstimateService;
use FastBillSdk\Estimate\EstimateValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use phpDocumentor\Reflection\Types\Object_;
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
        $estimate->items =[new \stdClass()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->createEstimate($estimate);
    }

    public function testCreateEstimateWithEmptyItemEntity()
    {
        $estimate = new EstimateEntity();
        $estimate->items =[new EstimateItemEntity()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->createEstimate($estimate);
    }

    public function testDeleteEstimateWithEmptyEntity()
    {
        $estimate = new EstimateEntity();
        $estimate->items =[new \stdClass()];

        $this->expectException(MissingPropertyException::class);
        $this->getEstimateServiceWithApiDummy()->deleteEstimate($estimate);
    }
}
