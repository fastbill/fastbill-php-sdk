<?php declare(strict_types=1);

namespace FastBillSdk\Contacts;

use FastBillSdk\Common\AbstractSearchStruct;

class ContactsSearchStruct extends AbstractSearchStruct
{
    public function setCustomerIdFilter(int $customerId)
    {
        $this->filters['CUSTOMER_ID'] = (string) $customerId;
    }

    public function setCustomerNumberFilter(string $customerNumber)
    {
        $this->filters['CUSTOMER_NUMBER'] = $customerNumber;
    }

    public function setContactId(string $contactId)
    {
        $this->filters['CONTACT_ID'] = $contactId;
    }

    /**
     * Search term in one of the given fields:
     * ORGANIZATION, FIRST_NAME, LAST_NAME, ADDRESS, ADDRESS_2, ZIPCODE, EMAIL, TAGS.
     *
     * @param string $searchTerm
     */
    public function setSearchTermFilter(string $searchTerm)
    {
        $this->filters['TERM'] = $searchTerm;
    }
}
