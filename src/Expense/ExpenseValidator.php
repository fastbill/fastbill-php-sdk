<?php
declare(strict_types=1);

namespace FastBillSdk\Expense;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\ExpenseItem\ExpenseItemEntity;
use FastBillSdk\ExpenseItem\ExpenseItemValidator;

class ExpenseValidator
{
    /**
     * @var ExpenseItemValidator
     */
    private $expenseItemValidator;

    public function __construct(ExpenseItemValidator $expenseItemValidator)
    {
        $this->expenseItemValidator = $expenseItemValidator;
    }

    public function validateRequiredCreationProperties(ExpenseEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkInvoiceDate($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkOrganization($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkSubTotal($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkItems($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(ExpenseEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(ExpenseEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkInvoiceId(ExpenseEntity $entity): void
    {
        if (!$entity->invoiceId) {
            throw new MissingPropertyException('The property invoiceId is not valid!');
        }
    }

    private function checkInvoiceDate(ExpenseEntity $entity): void
    {
        if (!$entity->invoiceDate) {
            throw new MissingPropertyException('The property invoiceDate is not valid!');
        }
    }

    private function checkOrganization(ExpenseEntity $entity): void
    {
        if (!$entity->organization) {
            throw new MissingPropertyException('The property organization is not valid!');
        }
    }

    private function checkSubTotal(ExpenseEntity $entity): void
    {
        if (!$entity->subTotal) {
            throw new MissingPropertyException('The property subTotal is not valid!');
        }
    }

    private function checkItems(ExpenseEntity $entity): void
    {
        if (!$entity->items) {
            throw new MissingPropertyException('The property items is not valid!');
        }

        foreach ($entity->items as $item) {
            if (!$item instanceof ExpenseItemEntity) {
                throw new \InvalidArgumentException('The given item is not a EstimateItemEntity');
            }

            $this->expenseItemValidator->checkDescription($item);
            $this->expenseItemValidator->checkUnitPrice($item);
            $this->expenseItemValidator->checkVatPercent($item);
            $this->expenseItemValidator->checkNetValue($item);
        }
    }
}
