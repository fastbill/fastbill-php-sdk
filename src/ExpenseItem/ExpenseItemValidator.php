<?php declare(strict_types=1);

namespace FastBillSdk\ExpenseItem;

use FastBillSdk\Common\MissingPropertyException;

class ExpenseItemValidator
{
    public function checkDescription(ExpenseItemEntity $entity): void
    {
        if (!$entity->description) {
            throw new MissingPropertyException('The property description is not valid!');
        }
    }

    public function checkUnitPrice(ExpenseItemEntity $entity): void
    {
        if (!$entity->unitPrice) {
            throw new MissingPropertyException('The property unitPrice is not valid!');
        }
    }

    public function checkVatPercent(ExpenseItemEntity $entity): void
    {
        if (!$entity->vatPercent) {
            throw new MissingPropertyException('The property vatPercent is not valid!');
        }
    }

    public function checkNetValue(ExpenseItemEntity $entity): void
    {
        if (!$entity->netValue) {
            throw new MissingPropertyException('The property netValue is not valid!');
        }
    }
}
