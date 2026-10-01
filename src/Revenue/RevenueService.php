<?php
declare(strict_types=1);

namespace FastBillSdk\Revenue;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class RevenueService
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
     * @var RevenueValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, RevenueValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @return RevenueEntity[]
     */
    public function getRevenue(RevenueSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('revenue.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->REVENUES->REVENUE as $revenueEntry) {
            $results[] = new RevenueEntity($revenueEntry);
        }

        return $results;
    }

    public function createRevenue(RevenueEntity $entity): RevenueEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('revenue.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->invoiceId = (string) $xml->RESPONSE->INVOICE_ID;

        return $entity;
    }

    public function setPaidRevenue(RevenueEntity $entity): RevenueEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('revenue.setpaid');
        $data = ['INVOICE_ID' => $entity->invoiceId];
        if ($entity->paidDate) {
            $data['PAID_DATE'] = $entity->paidDate;
        }
        $this->xmlService->setData($data);

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        if (isset($xml->RESPONSE->INVOICE_NUMBER)) {
            $entity->invoiceNumber = (string) $xml->RESPONSE->INVOICE_NUMBER;
        }

        return $entity;
    }

    public function deleteRevenue(RevenueEntity $entity): RevenueEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('revenue.delete');
        $this->xmlService->setData(['INVOICE_ID' => $entity->invoiceId]);

        $this->apiClient->post($this->xmlService->getXml());

        $entity->invoiceId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages): void
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\n", $errorMessages));
        }
    }
}
