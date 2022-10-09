<?php
declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;
use FastBillSdk\Expense\ExpenseEntity;
use FastBillSdk\Expense\ExpenseService;
use FastBillSdk\Expense\ExpenseValidator;
use FastBillSdk\ExpenseItem\ExpenseItemEntity;
use FastBillSdk\ExpenseItem\ExpenseItemValidator;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new ApiClient($username, $apiKey);

$expenseService = new ExpenseService(
    $fastBillClient,
    new XmlService(),
    new ExpenseValidator(new ExpenseItemValidator())
);
$entity = new ExpenseEntity();
$entity->invoiceDate = '2020-01-01';
$entity->servicePeriodStart = '2020-01-01';
$entity->servicePeriodEnd = '2020-12-31';
$entity->invoiceId = null;
$entity->subTotal = 1337;
$entity->organization = 'Test GmbH';
$entity->customerId = null;
$entity->projectId = null;

$invoiceItem = new ExpenseItemEntity();
$invoiceItem->description = 'FastBill SDK';
$invoiceItem->unitPrice = 1337;
$invoiceItem->vatPercent = 19;
$invoiceItem->netValue = 19;
$entity->items = [$invoiceItem, $invoiceItem];
$result = $expenseService->createExpense($entity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
