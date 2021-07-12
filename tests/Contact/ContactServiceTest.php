<?php
declare(strict_types=1);

namespace FastBillSdkTest\Contact;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Contact\ContactEntity;
use FastBillSdk\Contact\ContactSearchStruct;
use FastBillSdk\Contact\ContactService;
use FastBillSdk\Contact\ContactValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class ContactServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var ContactService
     */
    private $contactService;

    public function getContactService(): ContactService
    {
        if (!$this->contactService) {
            $this->contactService = new ContactService(
                $this->getApiClient(),
                $this->getXmlService(),
                new ContactValidator()
            );
        }

        return $this->contactService;
    }

    public function getContactServiceWithApiDummy(): ContactService
    {
        if (!$this->contactService) {
            $this->contactService = new ContactService(
                $this->getApiDummyClient(),
                $this->getXmlService(),
                new ContactValidator()
            );
        }

        return $this->contactService;
    }

    public function testGetContacts()
    {
        foreach ($this->getContactService()->getContact(new ContactSearchStruct()) as $contact) {
            self::assertInstanceOf(ContactEntity::class, $contact);
        }
    }

    public function testGetContactsWithFilters()
    {
        $searchStruct = new ContactSearchStruct();
        $searchStruct->setContactId(11);
        $searchStruct->setCustomerIdFilter(22);
        $searchStruct->setCustomerNumberFilter('KDNR33');
        $searchStruct->setSearchTermFilter('Musterfirma');

        $contacts = $this->getContactService()->getContact($searchStruct);

        self::assertCount(0, $contacts);
    }

    public function testCreateContactWithEmptyEntity()
    {
        $contact = new ContactEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getContactServiceWithApiDummy()->createContact($contact);
    }

    public function testUpdateContactWithEmptyEntity()
    {
        $contact = new ContactEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getContactServiceWithApiDummy()->updateContact($contact);
    }

    public function testUpdateContact()
    {
        $contact = new ContactEntity();
        $contact->customerId = 111;
        $contact->contactId = 222;

        self::assertEquals($this->getContactServiceWithApiDummy()->updateContact($contact), $contact);
    }

    public function testDeleteContactWithEmptyEntity()
    {
        $contact = new ContactEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getContactServiceWithApiDummy()->deleteContact($contact);
    }

    public function testDeleteContact()
    {
        $contact = new ContactEntity();
        $contact->contactId = 1337;
        $contact->customerId = 13337;

        $this->getContactServiceWithApiDummy()->deleteContact($contact);

        self::assertNull($contact->contactId);
    }
}
