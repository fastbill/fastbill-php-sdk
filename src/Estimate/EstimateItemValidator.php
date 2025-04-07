<?php
declare(strict_types=1);

namespace FastBillSdk\Estimate;

use FastBillSdk\Common\MissingPropertyException;

class EstimateItemValidator
{
    public function validateEstimateItem(EstimateItemEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkDescription($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkUnitPrice($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkVatPercent($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function checkDescription(EstimateItemEntity $entity)
    {
        if (!$entity->description) {
            throw new MissingPropertyException($entity->articleNumber . ': The property description is not valid!');
        }
    }

    public function checkUnitPrice(EstimateItemEntity $entity)
    {
        if (!$entity->unitPrice) {
            throw new MissingPropertyException($entity->articleNumber . ': The property unitPrice is not valid!');
        }
    }

    public function checkVatPercent(EstimateItemEntity $entity)
    {
        if (!is_numeric($entity->vatPercent)) {
            throw new MissingPropertyException($entity->articleNumber . ': The property vatPercent is not valid!');
        }
    }
}
