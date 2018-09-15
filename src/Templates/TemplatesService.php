<?php declare(strict_types=1);

namespace FastBillSdk\Templates;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;

class TemplatesService
{
    const SERVICE = 'template.get';

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

    /**
     * @return TemplatesEntity[]
     */
    public function getTemplate(): array
    {
        $this->xmlService->setService(self::SERVICE);
        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->TEMPLATES->TEMPLATE as $templatesEntry) {
            $results[] = new TemplatesEntity($templatesEntry);
        }

        return $results;
    }
}
