<?php

declare(strict_types=1);

namespace FastBillSdk\RecurringInvoice;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\ItemValidator;

class RecurringInvoiceValidator
{
    /**
     * @var ItemValidator
     */
    private $itemValidator;

    public function __construct(ItemValidator $itemValidator)
    {
        $this->itemValidator = $itemValidator;
    }

    public function validateRequiredCreationProperties(RecurringInvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkStartDate($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkFrequency($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkOutputType($entity);
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

    public function validateRequiredUpdateProperties(RecurringInvoiceEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(RecurringInvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(RecurringInvoiceEntity $entity): void
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkInvoiceId(RecurringInvoiceEntity $entity): void
    {
        if (!$entity->invoiceId) {
            throw new MissingPropertyException('The property invoiceId is not valid!');
        }
    }

    private function checkStartDate(RecurringInvoiceEntity $entity): void
    {
        if (!$entity->startDate) {
            throw new MissingPropertyException('The property startDate is not valid!');
        }
    }

    private function checkOutputType(RecurringInvoiceEntity $entity): void
    {
        if (!$entity->outputType || !in_array($entity->outputType, ['draft', 'Outgoing'], true)) {
            throw new MissingPropertyException('The property outputType is not valid!');
        }
    }

    private function checkFrequency(RecurringInvoiceEntity $entity): void
    {
        $allowedFrequencies = [
            'weekly',
            '2 weeks',
            '4 weeks',
            'monthly',
            '2 months',
            '3 months',
            '6 months',
            'yearly',
            '2 years',
        ];
        if (!$entity->frequency || !in_array($entity->frequency, $allowedFrequencies, true)) {
            throw new MissingPropertyException('The property frequency is not valid!');
        }
    }

    private function checkItems(RecurringInvoiceEntity $entity): void
    {
        if (!$entity->items) {
            throw new MissingPropertyException('The property items is not valid!');
        }

        foreach ($entity->items as $item) {
            if (!$item instanceof ItemEntity) {
                throw new \InvalidArgumentException('The given item is not a ItemEntity');
            }

            $this->itemValidator->checkDescription($item);
            $this->itemValidator->checkUnitPrice($item);
            $this->itemValidator->checkVatPercent($item);
        }
    }
}
