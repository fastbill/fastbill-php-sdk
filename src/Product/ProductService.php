<?php declare(strict_types=1);

namespace FastBillSdk\Product;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\XmlService;

class ProductService
{
    /**
     * @var ApiClientInterface
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    /**
     * @var ProductValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, ProductValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @return ProductEntity[]
     */
    public function getProducts(ProductSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('article.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $results = [];
        foreach ($xml->RESPONSE->ARTICLES->ARTICLE as $articleEntity) {
            $results[] = new ProductEntity($articleEntity);
        }

        return $results;
    }
}
