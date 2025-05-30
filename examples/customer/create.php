<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$customersService = new FastBillSdk\Customer\CustomerService(
    $fastBillClient,
    new FastBillSdk\Common\XmlService(),
    new FastBillSdk\Customer\CustomerValidator()
);

$customersEntity = new FastBillSdk\Customer\CustomerEntity();
$customersEntity->customerType = FastBillSdk\Customer\CustomerEntity::CUSTOMER_TYPE_CONSUMER;
$customersEntity->firstName = 'FirstName';
$customersEntity->lastName = 'LastName';
$result = $customersService->createCustomer($customersEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
