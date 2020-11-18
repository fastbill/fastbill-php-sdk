<?php declare(strict_types=1);

namespace FastBillSdk\Item;

use FastBillSdk\Common\MissingPropertyException;

class ItemValidator
{
    public function validateEstimateItem(ItemEntity $entity): array
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

    public function checkDescription(ItemEntity $entity)
    {
        if (!$entity->description) {
            throw new MissingPropertyException('The property description is not valid!');
        }
    }

    public function checkUnitPrice(ItemEntity $entity)
    {
        if (!$entity->unitPrice && $entity->unitPrice !== 0) {
            throw new MissingPropertyException('The property unitPrice is not valid!');
        }
    }

    public function checkVatPercent(ItemEntity $entity)
    {
        if (!$entity->vatPercent && $entity->vatPercent !== 0) {
            throw new MissingPropertyException('The property vatPercent is not valid!');
        }
    }
}
