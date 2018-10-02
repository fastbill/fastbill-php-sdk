<?php declare(strict_types=1);

namespace FastBillSdk\Estimate;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class EstimateService
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
     * @var EstimateValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, EstimateValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @param EstimateSearchStruct $searchStruct
     * @return EstimateEntity[]
     */
    public function getEstimate(EstimateSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('estimate.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->ESTIMATES->ESTIMATE as $estimateEntity) {
            $results[] = new EstimateEntity($estimateEntity);
        }

        return $results;
    }

    public function createEstimate(EstimateEntity $entity): EstimateEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('estimate.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->estimateId = (int) $xml->RESPONSE->ESTIMATE_ID;

        return $entity;
    }

    public function createInvoiceFromEstimate(EstimateEntity $entity): int
    {
        $this->checkErrors($this->validator->validateRequiredCreateInvoiceProperties($entity));

        $this->xmlService->setService('estimate.createinvoice');
        $this->xmlService->setData(['ESTIMATE_ID' => $entity->estimateId]);

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        return (int) $xml->RESPONSE->INVOICE_ID;
    }

    public function sendEstimateByEmail(
        int $estimateId,
        string $recipient,
        string $subject = null,
        string $message = null,
        bool $receiptConfirmation = false
    ): string {
        $this->xmlService->setService('estimate.sendbyemail');
        $data['ESTIMATE_ID'] = $estimateId;
        $data['RECIPIENT'] = $recipient;

        if ($subject) {
            $data['SUBJECT'] = $subject;
        }

        if ($message) {
            $data['MESSAGE'] = $message;
        }

        if ($receiptConfirmation) {
            $data['RECEIPT_CONFIRMATION'] = $recipient;
        }

        $this->xmlService->setData($data);

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        return (string) $xml->RESPONSE->STATUS;
    }

    public function deleteEstimate(EstimateEntity $entity): EstimateEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));

        $this->xmlService->setService('estimate.delete');
        $this->xmlService->setData(['ESTIMATE_ID' => $entity->estimateId]);

        $this->apiClient->post($this->xmlService->getXml());

        $entity->estimateId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\r\n", $errorMessages));
        }
    }
}
