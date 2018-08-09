<?php declare(strict_types=1);

namespace FastBillSdk\Worktimes;

use FastBillSdk\Api\ApiClient;
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

    public function __construct(ApiClient $apiClient, XmlService $xmlService)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
    }

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
            $results[] = (new WorktimesGetResult())->setData($timeEntry);
        }

        return $results;
    }
}
