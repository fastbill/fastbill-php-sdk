<?php declare(strict_types=1);

namespace FastBillSdk\Contacts;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class ContactsService
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    /**
     * @var ContactsValidator
     */
    private $validator;

    public function __construct(ApiClient $apiClient, XmlService $xmlService, ContactsValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @param ContactsSearchStruct $searchStruct
     * @return ContactsEntity[]
     */
    public function getContact(ContactsSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('contact.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $results = [];
        foreach ($xml->RESPONSE->CONTACTS->ELEMENT as $contactEntity) {
            $results[] = new ContactsEntity($contactEntity);
        }

        return $results;
    }

    public function createContact(ContactsEntity $entity): ContactsEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('contact.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->contactId = (int) $xml->RESPONSE->CONTACT_ID;

        return $entity;
    }

    public function updateContact(ContactsEntity $entity): ContactsEntity
    {
        $this->checkErrors($this->validator->validateRequiredUpdateProperties($entity));

        $this->xmlService->setService('contact.update');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        return $entity;
    }

    public function deleteContact(ContactsEntity $entity): ContactsEntity
    {
        $this->checkErrors($this->validator->validateRequiredDeleteProperties($entity));

        $this->xmlService->setService('contact.delete');
        $this->xmlService->setData($entity->getXmlData());

        $this->apiClient->post($this->xmlService->getXml());

        $entity->contactId = null;

        return $entity;
    }

    private function checkErrors(array $errorMessages)
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\r\n", $errorMessages));
        }
    }
}
