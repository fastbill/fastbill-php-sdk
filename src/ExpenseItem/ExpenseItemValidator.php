<?php declare(strict_types=1);

namespace FastBillSdk\ExpenseItem;

use FastBillSdk\Common\MissingPropertyException;

class ExpenseItemValidator
{
    public function checkDescription(ExpenseItemEntity $entity)
    {
        if (!$entity->description) {
            throw new MissingPropertyException('The property description is not valid!');
        }
    }

    public function checkUnitPrice(ExpenseItemEntity $entity)
    {
        if (!$entity->unitPrice) {
            throw new MissingPropertyException('The property unitPrice is not valid!');
        }
    }

    public function checkVatPercent(ExpenseItemEntity $entity)
    {
        if (!$entity->vatPercent) {
            throw new MissingPropertyException('The property vatPercent is not valid!');
        }
    }

    public function checkNetValue(ExpenseItemEntity $entity)
    {
        if (!$entity->netValue) {
            throw new MissingPropertyException('The property netValue is not valid!');
        }
    }
}
