<?php
declare(strict_types=1);

namespace FastBillSdk\Product;

use FastBillSdk\Common\MissingPropertyException;

class ProductValidator
{
    public function validateRequiredCreationProperties(ProductEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkArticleNumber($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkTitle($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        try {
            $this->checkUnitPrice($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredUpdateProperties(ProductEntity $entity): array
    {
        $errorMessages = $this->validateRequiredCreationProperties($entity);

        try {
            $this->checkArticleId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    public function validateRequiredDeleteProperties(ProductEntity $entity): array
    {
        $errorMessages = [];

        try {
            $this->checkArticleId($entity);
        } catch (MissingPropertyException $exception) {
            $errorMessages[] = $exception->getMessage();
        }

        return $errorMessages;
    }

    private function checkArticleId(ProductEntity $entity): void
    {
        if (!$entity->articleId) {
            throw new MissingPropertyException('The property articleId is not valid!');
        }
    }

    private function checkArticleNumber(ProductEntity $entity): void
    {
        if (!$entity->articleNumber) {
            throw new MissingPropertyException('The property articleNumber is not valid!');
        }
    }

    private function checkTitle(ProductEntity $entity): void
    {
        if (!$entity->title) {
            throw new MissingPropertyException('The property title is not valid!');
        }
    }

    private function checkUnitPrice(ProductEntity $entity): void
    {
        if (!$entity->unitPrice) {
            throw new MissingPropertyException('The property unitPrice is not valid!');
        }
    }
}
