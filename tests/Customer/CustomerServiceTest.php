<?php
declare(strict_types=1);

namespace FastBillSdkTest\Customer;

use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Customer\CustomerEntity;
use FastBillSdk\Customer\CustomerSearchStruct;
use FastBillSdk\Customer\CustomerService;
use FastBillSdk\Customer\CustomerValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var CustomerService
     */
    private $customerService;

    public function getCustomerService(): CustomerService
    {
        if (!$this->customerService) {
            $this->customerService = new CustomerService(
                $this->getApiClient(),
                $this->getXmlService(),
                new CustomerValidator()
            );
        }

        return $this->customerService;
    }

    public function getCustomerServiceWithApiDummy(): CustomerService
    {
        if (!$this->customerService) {
            $this->customerService = new CustomerService(
                $this->getApiDummyClient(),
                $this->getXmlService(),
                new CustomerValidator()
            );
        }

        return $this->customerService;
    }

    public function testGetCustomers()
    {
        $customers = $this->getCustomerService()->getCustomer(new CustomerSearchStruct());
        foreach ($customers as $customer) {
            self::assertInstanceOf(CustomerEntity::class, $customer);
        }
    }

    public function testGetCustomersWithFilters()
    {
        $searchStruct = new CustomerSearchStruct();
        $searchStruct->setCustomerIdFilter(22);
        $searchStruct->setCustomerNumberFilter('KDNR33');
        $searchStruct->setCustomerIdFilter(123);
        $searchStruct->setCityFilter('Musterstadt');
        $searchStruct->setCountryCodeFilter('DE');
        $searchStruct->setSearchTermFilter('Musterfirma');

        $customers = $this->getCustomerservice()->getCustomer($searchStruct);

        self::assertCount(0, $customers);
    }

    public function testCreateCustomerWithEmptyEntity()
    {
        $customer = new CustomerEntity();
        $customer->customerType = 'business';

        $this->expectException(MissingPropertyException::class);
        $this->getCustomerServiceWithApiDummy()->createCustomer($customer);
    }

    public function testCreateCustomerWithMissingProperties()
    {
        $customer = new CustomerEntity();
        $customer->customerType = 'consumer';

        $this->expectException(MissingPropertyException::class);
        $this->getCustomerServiceWithApiDummy()->createCustomer($customer);
    }

    public function testUpdateCustomerWithEmptyEntity()
    {
        $customer = new CustomerEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getCustomerServiceWithApiDummy()->updateCustomer($customer);
    }

    public function testUpdateCustomer()
    {
        $customer = new CustomerEntity();
        $customer->customerId = 111;
        $customer->customerType = 'business';
        $customer->organization = 'Bullshit Productions';

        self::assertEquals($this->getCustomerServiceWithApiDummy()->updateCustomer($customer), $customer);
    }

    public function testDeleteCustomerWithEmptyEntity()
    {
        $customer = new CustomerEntity();

        $this->expectException(MissingPropertyException::class);
        $this->getCustomerServiceWithApiDummy()->deleteCustomer($customer);
    }

    public function testDeleteCustomer()
    {
        $customer = new CustomerEntity();
        $customer->customerId = 1337;

        $this->getCustomerServiceWithApiDummy()->deleteCustomer($customer);

        self::assertNull($customer->customerId);
    }
}
