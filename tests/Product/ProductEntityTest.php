<?php declare(strict_types=1);

namespace FastBillSdkTest\Product;

use FastBillSdk\Product\ProductEntity;
use PHPUnit\Framework\TestCase;

class ProductEntityTest extends TestCase
{
    public function tesstSetData()
    {
        $entity = new ProductEntity(
            /*new \SimpleXMLElement(
                file_get_contents(__DIR__ . '/_fixtures/worktimes_entity.xml')
            )*/
        );
    }
}
