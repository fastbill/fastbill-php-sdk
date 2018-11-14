<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class InvoiceService
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
     * @var InvoiceValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, InvoiceValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @param InvoiceSearchStruct $searchStruct
     * @return InvoiceEntity[]
     */
    public function getInvoice(InvoiceSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('invoice.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->INVOICES->INVOICE as $invoiceEntry) {
            $results[] = new InvoiceEntity($invoiceEntry);
        }

        return $results;
    }

    public function createInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('invoice.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->invoiceId = $xml->RESPONSE->INVOICE_ID;

        return $entity;
    }

    public function updateInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));

        $this->xmlService->setService('invoice.update');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function deleteInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));

        $this->xmlService->setService('invoice.delete');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        $entity->invoiceId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\n", $errorMessages));
        }
    }
}
