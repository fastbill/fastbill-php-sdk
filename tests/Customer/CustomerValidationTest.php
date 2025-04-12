<?php
declare(strict_types=1);

namespace FastBillSdkTest\Customer;

use FastBillSdk\Customer\CustomerEntity;
use FastBillSdk\Customer\CustomerValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class CustomerValidationTest extends TestCase
{
    use BaseTestTrait;

    public function testIbanValidation()
    {
        $customer = new CustomerEntity();
        $customer->bankIban = 'DE99370400440532013000'; // Example wrong IBAN

        $validator = new CustomerValidator();
        $errors = $validator->validateRequiredCreationProperties($customer);

        self::assertContains('The property bankIban is not valid!', $errors);
    }
}
