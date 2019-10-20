<?php declare(strict_types=1);

namespace FastBillSdkTest\Product;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Product\ProductEntity;
use FastBillSdk\Product\ProductSearchStruct;
use FastBillSdk\Product\ProductService;
use FastBillSdk\Product\ProductValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var ProductService
     */
    private $productServiceWithApiDummy;

    public function getProductService(): ProductService
    {
        if (!$this->productService) {
            $this->productService = new ProductService(
                $this->getApiClient(),
                $this->getXmlService(),
                new ProductValidator()
            );
        }

        return $this->productService;
    }

    public function getProductServiceWithApiDummy(): ProductService
    {
        if (!$this->productServiceWithApiDummy) {
            $this->productServiceWithApiDummy = new ProductService(
                $this->getApiDummyClient(),
                $this->getXmlService(),
                new ProductValidator()
            );
        }

        return $this->productServiceWithApiDummy;
    }

    public function testGetProducts()
    {
        foreach ($this->getProductService()->getProducts(new ProductSearchStruct()) as $product) {
            self::assertInstanceOf(ProductEntity::class, $product);
        }
    }

    public function testGetProductsWithArticleNumberFilter()
    {
        $searchStruct = new ProductSearchStruct();
        $searchStruct->setArticleNumberFilter('10001');
        $products = $this->getProductService()->getProducts($searchStruct);
        self::assertEquals('10001', $products[0]->articleNumber);
        self::assertCount(1, $products);
    }

    public function testCreateProductWithEmptyEntity()
    {
        $product = new ProductEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getProductServiceWithApiDummy()->createProduct($product);
    }

    public function testUpdateProductWithEmptyEntity()
    {
        $product = new ProductEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getProductServiceWithApiDummy()->updateProduct($product);
    }

    public function testUpdateProduct()
    {
        $product = new ProductEntity();
        $product->articleId = 1337;
        $product->title = 'FastBill SDK';
        $product->unitPrice = 1337;
        $product->articleNumber = 42;

        self::assertEquals($this->getProductServiceWithApiDummy()->updateProduct($product), $product);
    }

    public function testDeleteProductWithEmptyEntity()
    {
        $product = new ProductEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getProductServiceWithApiDummy()->deleteProduct($product);
    }

    public function testDeleteProduct()
    {
        $product = new ProductEntity();
        $product->articleId = 1337;

        $this->getProductServiceWithApiDummy()->deleteProduct($product);

        self::assertNull($product->articleId);
    }
}
