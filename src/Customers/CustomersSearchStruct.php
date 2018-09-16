<?php declare(strict_types=1);

namespace FastBillSdk\Customers;

use FastBillSdk\Common\AbstractSearchStruct;

class CustomersSearchStruct extends AbstractSearchStruct
{
    public function setCustomerIdFilter(int $customerId)
    {
        $this->filters['CUSTOMER_ID'] =  $customerId;
    }

    public function setCustomerNumberFilter(string $customerNumber)
    {
        $this->filters['CUSTOMER_NUMBER'] = $customerNumber;
    }

    public function setCountryCodeFilter(string $countryCode)
    {
        $this->filters['COUNTRY_CODE'] = $countryCode;
    }

    public function setCityFilter(string $city)
    {
        $this->filters['CITY'] = $city;
    }

    /**
     * Search term in one of the given fields:
     * ORGANIZATION, FIRST_NAME, LAST_NAME, ADDRESS, ADDRESS_2, ZIPCODE, EMAIL, TAGS.
     * @param string $searchTerm
     */
    public function setSearchTermFilter(string $searchTerm)
    {
        $this->filters['TERM'] = $searchTerm;
    }
}
