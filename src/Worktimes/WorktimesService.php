<?php declare(strict_types=1);

namespace FastBillSdk\Worktimes;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class WorktimesService
{
    const SERVICE = 'time.get';

    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    /**
     * @var WorktimesValidator
     */
    private $validator;

    public function __construct(ApiClient $apiClient, XmlService $xmlService, WorktimesValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @param WorktimesSearchStruct $searchStruct
     * @return WorktimesEntity[]
     */
    public function getTime(WorktimesSearchStruct $searchStruct): array
    {
        $this->xmlService->setService(self::SERVICE);
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->TIMES->TIME as $timeEntry) {
            $results[] = new WorktimesEntity($timeEntry);
        }

        return $results;
    }

    public function createTime(WorktimesEntity $entity): WorktimesEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService(self::SERVICE);
        $this->xmlService->getXml();
    }

    public function updateTime(WorktimesEntity $entity): WorktimesEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));
    }

    public function deleteTime(WorktimesEntity $entity): WorktimesEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\r\n", $errorMessages));
        }
    }
}
