<?php declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\RecipientEntity;
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

    public function updateInvoice(InvoiceEntity $entity, $deleteExistingItems = true): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));

        $this->xmlService->setService('invoice.update');
        $xml = array_merge(['DELETE_EXISTING_ITEMS' => (int) $deleteExistingItems], $entity->getXmlData());
        $this->xmlService->setData($xml);

        $this->apiClient->post($this->xmlService->getXml());

        $searchStruct = new InvoiceSearchStruct();
        $searchStruct->setInvoiceIdFilter((int)$entity->invoiceId);
        $entity = $this->getInvoice($searchStruct)[0];

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

    public function completeInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('invoice.complete');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function cancelInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('invoice.cancel');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function sendByEmailInvoice(
        InvoiceEntity $entity,
        RecipientEntity $recipient,
        string $subject = null,
        string $message = null,
        bool $receiptConfirmation = false
    ): string {
        $this->xmlService->setService('invoice.sendbyemail');
        $data['INVOICE_ID'] = $entity->invoiceId;

        $recipient->applyEmails($data);

        if ($subject) {
            $data['SUBJECT'] = $subject;
        }

        if ($message) {
            $data['MESSAGE'] = $message;
        }

        if ($receiptConfirmation) {
            $data['RECEIPT_CONFIRMATION'] = $receiptConfirmation;
        }

        $this->xmlService->setData($data);

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        return (string) $xml->RESPONSE->STATUS;
    }

    public function sendByPostInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('invoice.sendbypost');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function setPaidInvoice(InvoiceEntity $entity): InvoiceEntity
    {
        $this->checkErrors($this->validator->validateRequiredInvoiceId($entity));

        $this->xmlService->setService('invoice.setpaid');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\n", $errorMessages));
        }
    }
}
