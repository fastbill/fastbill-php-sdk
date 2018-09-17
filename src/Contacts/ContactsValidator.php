<?php declare(strict_types=1);

namespace FastBillSdk\Contacts;

use FastBillSdk\Common\MissingPropertyException;

class ContactsValidator
{
    public function validateRequiredCreationProperties(ContactsEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(ContactsEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkContactId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(ContactsEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkContactId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(ContactsEntity $entity)
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkContactId(ContactsEntity $entity)
    {
        if (!$entity->contactId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }
}
