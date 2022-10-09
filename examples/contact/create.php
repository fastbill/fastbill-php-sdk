<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$customersService = new FastBillSdk\Contact\ContactService(
    $fastBillClient,
    new \FastBillSdk\Common\XmlService(),
    new \FastBillSdk\Contact\ContactValidator()
);
$contactEntity = new \FastBillSdk\Contact\ContactEntity();
$contactEntity->customerId = 123123123;
$contactEntity->firstName = 'Max';
$contactEntity->lastName = 'Mustermann';
$result = $customersService->createContact($contactEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
