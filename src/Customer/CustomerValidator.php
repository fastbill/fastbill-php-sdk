<?php
declare(strict_types=1);

namespace FastBillSdk\Customer;

use FastBillSdk\Common\MissingPropertyException;

class CustomerValidator
{
    public function validateRequiredCreationProperties(CustomerEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerType($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkOrganization($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkFirstName($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkLastName($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(CustomerEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(CustomerEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(CustomerEntity $entity)
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkCustomerType(CustomerEntity $entity)
    {
        if (!$entity->customerType || !\in_array($entity->customerType, ['business', 'consumer'], true)) {
            throw new MissingPropertyException('The property customerType is not valid! Only business or consumer as value is allowed!');
        }
    }

    private function checkOrganization(CustomerEntity $entity)
    {
        if (!$entity->organization && $this->isBusiness($entity)) {
            throw new MissingPropertyException('The property organization is not valid!');
        }
    }

    private function checkFirstName(CustomerEntity $entity)
    {
        if (!$entity->firstName && $this->isConsumer($entity)) {
            throw new MissingPropertyException('The property firstName is not valid!');
        }
    }

    private function checkLastName(CustomerEntity $entity)
    {
        if (!$entity->lastName && $this->isConsumer($entity)) {
            throw new MissingPropertyException('The property lastName is not valid!');
        }
    }

    private function isConsumer(CustomerEntity $entity): bool
    {
        return $entity->customerType === CustomerEntity::CUSTOMER_TYPE_CONSUMER;
    }

    private function isBusiness(CustomerEntity $entity): bool
    {
        return $entity->customerType === CustomerEntity::CUSTOMER_TYPE_BUSINESS;
    }
}
