<?php declare(strict_types=1);

namespace FastBillSdkTest\WorkTime;

use FastBillSdk\WorkTime\WorkTimeEntity;
use FastBillSdk\WorkTime\WorkTimeValidator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \FastBillSdk\WorkTime\WorkTimeValidator
 */
class WorkTimeValidatorTest extends TestCase
{
    /**
     * @var WorkTimeValidator
     */
    private $validator;

    private function getValidator(): WorkTimeValidator
    {
        if (!$this->validator) {
            $this->validator = new WorkTimeValidator();
        }

        return $this->validator;
    }

    /**
     * @covers::validateRequiredCreationProperties
     * @covers::checkCustomerId
     * @covers::checkProjectId
     * @covers::checkStartTime
     */
    public function testValidateRequiredCreationProperties()
    {
        $entity = new WorkTimeEntity();

        $errorMessages = $this->getValidator()->validateRequiredCreationProperties($entity);

        self::assertEquals('The property customerId is not valid!', $errorMessages[0]);
        self::assertEquals('The property projectId is not valid!', $errorMessages[1]);
        self::assertEquals('The property startTime is not valid!', $errorMessages[2]);
    }

    /**
     * @covers::validateRequiredCreationProperties
     * @covers::validateRequiredUpdateProperties
     * @covers::checkCustomerId
     * @covers::checkProjectId
     * @covers::checkStartTime
     * @covers::checkTimeId
     */
    public function testValidateRequiredUpdateProperties()
    {
        $entity = new WorkTimeEntity();

        $errorMessages = $this->getValidator()->validateRequiredUpdateProperties($entity);

        self::assertEquals('The property customerId is not valid!', $errorMessages[0]);
        self::assertEquals('The property projectId is not valid!', $errorMessages[1]);
        self::assertEquals('The property startTime is not valid!', $errorMessages[2]);
        self::assertEquals('The property timeId is not valid!', $errorMessages[3]);

        $entity = new WorkTimeEntity(
            new \SimpleXMLElement(
                file_get_contents(__DIR__ . '/_fixtures/worktimes_entity.xml')
            )
        );
        // no exception should occur

        $this->getValidator()->validateRequiredUpdateProperties($entity);
    }

    /**
     * @covers::validateRequiredDeleteProperties
     * @covers::checkTimeId
     */
    public function testValidateRequiredDeleteProperties()
    {
        $entity = new WorkTimeEntity();

        $errorMessages = $this->getValidator()->validateRequiredDeleteProperties($entity);

        self::assertEquals('The property timeId is not valid!', $errorMessages[0]);
    }
}
