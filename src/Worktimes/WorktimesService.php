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
        /*$response = $this->apiClient->post(
            '<?xml version="1.0" encoding="utf-8"?>
                    <FBAPI>
                         <SERVICE>time.get</SERVICE>
                         ' . $filterString . '
                         <LIMIT>' . $searchStruct->getLimit() . '</LIMIT>
                         <OFFSET>' . $searchStruct->getOffset() . '</OFFSET>
                    </FBAPI>'
        );*/

//        $xml = new \SimpleXMLElement((string) $response->getBody());
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?>
<FBAPI>
    <REQUEST>
        <SERVICE>time.get</SERVICE>
        <FILTER>
            <CUSTOMER_ID>4545366</CUSTOMER_ID>
        </FILTER>
        <LIMIT>100</LIMIT>
    </REQUEST>
    <RESPONSE>
        <TIMES>
            <TIME>
                <TIME_ID>896950</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-06-25 22:47:34</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>30</MINUTES>
                <BILLABLE_MINUTES>30</BILLABLE_MINUTES>
                <COMMENT>Umsetzung Datenschutz für Google Analytics</COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>896948</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-06-25 22:12:29</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>30</MINUTES>
                <BILLABLE_MINUTES>30</BILLABLE_MINUTES>
                <COMMENT>Checkbox Kontaktformular Datenschutzbestimmung</COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>893498</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-06-20 10:34:04</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>60</MINUTES>
                <BILLABLE_MINUTES>60</BILLABLE_MINUTES>
                <COMMENT>Besprechung DSGVO Maßnahmen</COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>859362</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-05-03 13:23:11</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>30</MINUTES>
                <BILLABLE_MINUTES>30</BILLABLE_MINUTES>
                <COMMENT>Shopware Installation</COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>859360</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-05-03 13:22:56</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>30</MINUTES>
                <BILLABLE_MINUTES>30</BILLABLE_MINUTES>
                <COMMENT>Instandsetzung Wordpress
                    Schriftarten
                    neue Benutzer angelegt.
                </COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>819320</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <DATE>2018-03-08 14:12:18</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>90</MINUTES>
                <BILLABLE_MINUTES>90</BILLABLE_MINUTES>
                <COMMENT>Aktualisierung der Wordpressseiten und der php Version auf php7.2 und wordpress 4.9.4</COMMENT>
            </TIME>
            <TIME>
                <TIME_ID>750274</TIME_ID>
                <CUSTOMER_ID>4545366</CUSTOMER_ID>
                <PROJECT_ID>175100</PROJECT_ID>
                <INVOICE_ID>11114348</INVOICE_ID>
                <DATE>2017-11-28 20:56:56</DATE>
                <START_TIME>0000-00-00 00:00:00</START_TIME>
                <END_TIME>0000-00-00 00:00:00</END_TIME>
                <MINUTES>60</MINUTES>
                <BILLABLE_MINUTES>60</BILLABLE_MINUTES>
                <COMMENT>Besprechung Webseitenkonzept</COMMENT>
            </TIME>
        </TIMES>
    </RESPONSE>
</FBAPI>');
        $results = [];
        foreach ($xml->RESPONSE->TIMES->TIME as $timeEntry) {
            $results[] = (new WorktimesGetResult())->setData($timeEntry);
        }

        return $results;
    }
}
