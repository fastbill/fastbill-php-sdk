<?php declare(strict_types=1);

namespace FastBillSdk\RecurringInvoice;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class RecurringInvoiceService
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
     * @var RecurringInvoiceValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, RecurringInvoiceValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @return RecurringInvoiceEntity[]
     */
    public function getRecurringInvoices(RecurringInvoiceSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('recurring.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $results = [];
        foreach ($xml->RESPONSE->INVOICES->INVOICE as $articleEntity) {
            $results[] = new RecurringInvoiceEntity($articleEntity);
        }

        return $results;
    }

    public function createRecurringInvoice(RecurringInvoiceEntity $entity): RecurringInvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('recurring.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->invoiceId = (int) $xml->RESPONSE->INVOICE_ID;

        return $entity;
    }

    public function updateRecurringInvoice(RecurringInvoiceEntity $entity): RecurringInvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));

        $this->xmlService->setService('recurring.update');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function deleteRecurringInvoice(RecurringInvoiceEntity $entity): RecurringInvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));

        $this->xmlService->setService('recurring.delete');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        $entity->invoiceId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\r\n", $errorMessages));
        }
    }
}
