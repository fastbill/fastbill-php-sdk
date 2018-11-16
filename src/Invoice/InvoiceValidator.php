<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\ItemValidator;

class InvoiceValidator
{
    /**
     * @var ItemValidator
     */
    private $itemValidator;

    public function __construct(ItemValidator $itemValidator)
    {
        $this->itemValidator = $itemValidator;
    }

    public function validateRequiredCreationProperties(InvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
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

    public function validateRequiredUpdateProperties(InvoiceEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(InvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredInvoiceId(InvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkInvoiceId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(InvoiceEntity $entity)
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkItems(InvoiceEntity $entity)
    {
        if (!$entity->items) {
            throw new MissingPropertyException('The property items is not valid!');
        }

        foreach ($entity->items as $item) {
            if (!$item instanceof ItemEntity) {
                throw new \InvalidArgumentException('The given item is not a EstimateItemEntity');
            }

            $this->itemValidator->checkDescription($item);
            $this->itemValidator->checkUnitPrice($item);
            $this->itemValidator->checkVatPercent($item);
        }
    }

    private function checkInvoiceId(InvoiceEntity $entity)
    {
        if (!$entity->invoiceId) {
            throw new MissingPropertyException('The property invoiceId is not valid!');
        }
    }
}
