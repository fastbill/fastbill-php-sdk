<?php declare(strict_types=1);

namespace FastBillSdk\Customers;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class CustomersService
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    /**
     * @var CustomersValidator
     */
    private $validator;

    public function __construct(ApiClient $apiClient, XmlService $xmlService, CustomersValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @param CustomersSearchStruct $searchStruct
     * @return CustomersEntity[]
     */
    public function getCustomer(CustomersSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('customer.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->CUSTOMERS->CUSTOMER as $customerEntity) {
            $results[] = new CustomersEntity($customerEntity);
        }

        return $results;
    }

    public function createCustomer(CustomersEntity $entity): CustomersEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('customer.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->customerId = (int) $xml->RESPONSE->CUSTOMER_ID;

        return $entity;
    }

    public function updateCustomer(CustomersEntity $entity): CustomersEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));

        $this->xmlService->setService('customer.update');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function deleteCustomer(CustomersEntity $entity): CustomersEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));

        $this->xmlService->setService('customer.delete');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        $entity->customerId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\r\n", $errorMessages));
        }
    }
}
