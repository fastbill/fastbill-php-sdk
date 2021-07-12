<?php
declare(strict_types=1);

namespace FastBillSdkTest\Item;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\ItemValidator;
use PHPUnit\Framework\TestCase;

class ItemValidatorTest extends TestCase
{
    public function getItemValidator(): ItemValidator
    {
        return new ItemValidator();
    }

    public function testVatValueZeroIsAllowed()
    {
        $item = new ItemEntity();
        $item->vatPercent = 0;

        $result = true;

        try {
            $this->getItemValidator()->checkVatPercent($item);
        } catch (MissingPropertyException $e) {
            $result = false;
        }

        self::assertTrue($result);
    }

    public function testUnitPriceValueZeroIsAllowed()
    {
        $item = new ItemEntity();
        $item->unitPrice = 0;

        $result = true;

        try {
            $this->getItemValidator()->checkUnitPrice($item);
        } catch (MissingPropertyException $e) {
            $result = false;
        }

        self::assertTrue($result);
    }
}
