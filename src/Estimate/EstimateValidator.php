<?php declare(strict_types=1);

namespace FastBillSdk\Estimate;

use FastBillSdk\Common\MissingPropertyException;

class EstimateValidator
{
    /**
     * @var EstimateItemValidator
     */
    private $estimateItemValidator;

    public function __construct(EstimateItemValidator $estimateItemValidator)
    {
        $this->estimateItemValidator = $estimateItemValidator;
    }

    public function validateRequiredCreationProperties(EstimateEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkItems($entity);
        } catch (\InvalidArgumentException $exception) {
            $errorMessages[] = $exception->getMessage();
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredCreateInvoiceProperties(EstimateEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkEstimateId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(EstimateEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkEstimateId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(EstimateEntity $entity)
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkEstimateId(EstimateEntity $entity)
    {
        if (!$entity->estimateId) {
            throw new MissingPropertyException('The property estimateId is not valid!');
        }
    }

    /**
     * @param EstimateEntity $entity
     * @throws \InvalidArgumentException
     * @throws MissingPropertyException
     */
    private function checkItems(EstimateEntity $entity)
    {
        foreach ($entity->items as $item) {
            if (!$item instanceof EstimateItemEntity) {
                throw new \InvalidArgumentException('The given item is not a EstimateItemEntity');
            }

            $this->estimateItemValidator->checkDescription($item);
            $this->estimateItemValidator->checkUnitPrice($item);
            $this->estimateItemValidator->checkVatPercent($item);
        }
    }
}
