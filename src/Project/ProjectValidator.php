<?php declare(strict_types=1);

namespace FastBillSdk\Project;

use FastBillSdk\Common\MissingPropertyException;

class ProjectValidator
{
    public function validateRequiredCreationProperties(ProjectEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkCustomerId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkProjectName($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(ProjectEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkProjectId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(ProjectEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkProjectId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkCustomerId(ProjectEntity $entity)
    {
        if (!$entity->customerId) {
            throw new MissingPropertyException('The property customerId is not valid!');
        }
    }

    private function checkProjectId(ProjectEntity $entity)
    {
        if (!$entity->projectId) {
            throw new MissingPropertyException('The property projectId is not valid!');
        }
    }

    private function checkProjectName(ProjectEntity $entity)
    {
        if (!$entity->projectName) {
            throw new MissingPropertyException('The property projectName is not valid!');
        }
    }
}
