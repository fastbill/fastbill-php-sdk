<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Common\MissingPropertyException;

class InvoiceValidator
{
    public function validateRequiredCreationProperties(InvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkProjectId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkStartTime($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(InvoiceEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkTimeId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(InvoiceEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkTimeId($entity);
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

    private function checkProjectId(InvoiceEntity $entity)
    {
        if (!$entity->projectId) {
            throw new MissingPropertyException('The property projectId is not valid!');
        }
    }

    private function checkStartTime(InvoiceEntity $entity)
    {
        if (!$entity->startTime) {
            throw new MissingPropertyException('The property startTime is not valid!');
        }
    }

    private function checkTimeId(InvoiceEntity $entity)
    {
        if (!$entity->timeId) {
            throw new MissingPropertyException('The property timeId is not valid!');
        }
    }
}
