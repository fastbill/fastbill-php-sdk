<?php declare(strict_types=1);

namespace FastBillSdk\Worktimes;

use FastBillSdk\Api\ApiClient;

class WorktimesService
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getTime(WorktimesSearchStruct $searchStruct): array
    {
        $filterString = '';
        if (\count($searchStruct->getFilters()) > 0) {
            $filterString = '<FILTER>';
            foreach ($searchStruct->getFilters() as $key => $value) {
                $filterString .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
            $filterString .= '</FILTER>';
        }
        /**
         * TODO change xml generation
         */
        $response = $this->apiClient->post(
            '<?xml version="1.0" encoding="utf-8"?>
                    <FBAPI>
                         <SERVICE>time.get</SERVICE>
                         ' . $filterString . '
                         <LIMIT>' . $searchStruct->getLimit() . '</LIMIT>
                         <OFFSET>' . $searchStruct->getOffset() . '</OFFSET>
                    </FBAPI>'
        );

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->TIMES->TIME as $timeEntry) {
            $results[] = (new WorktimesGetResult())->setData($timeEntry);
        }

        return $results;
    }
}
