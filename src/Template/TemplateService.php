<?php
declare(strict_types=1);

namespace FastBillSdk\Template;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\XmlService;

class TemplateService
{
    const SERVICE = 'template.get';

    /**
     * @var ApiClientInterface
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
    }

    /**
     * @return TemplateEntity[]
     */
    public function getTemplate(): array
    {
        $this->xmlService->setService(self::SERVICE);
        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->TEMPLATES->TEMPLATE as $templatesEntry) {
            $results[] = new TemplateEntity($templatesEntry);
        }

        return $results;
    }
}
