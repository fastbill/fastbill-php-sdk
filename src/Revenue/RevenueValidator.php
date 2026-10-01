<?php
declare(strict_types=1);

namespace FastBillSdk\Revenue;

use FastBillSdk\Common\MissingPropertyException;

class RevenueValidator
{
    public function validateRequiredCreationProperties(RevenueEntity $entity): array
    {
        $errorMessages = [];

        foreach (['invoiceDate', 'customerId', 'subTotal'] as $property) {
            try {
                $this->checkProperty($entity, $property);
            } catch (MissingPropertyException $exception) {
                $errorMessages[] = $exception->getMessage();
            }
        }

        return $errorMessages;
    }

    public function validateRequiredInvoiceId(RevenueEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkProperty($entity, 'invoiceId');
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkProperty(RevenueEntity $entity, string $property): void
    {
        if (!$entity->$property) {
            throw new MissingPropertyException(sprintf('The property %s is not valid!', $property));
        }
    }
}
