<?php
declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\ItemValidator;
use FastBillSdk\RecurringInvoice\RecurringInvoiceEntity;
use FastBillSdk\RecurringInvoice\RecurringInvoiceService;
use FastBillSdk\RecurringInvoice\RecurringInvoiceValidator;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new ApiClient($username, $apiKey);

$recurringInvoiceService = new RecurringInvoiceService(
    $fastBillClient,
    new XmlService(),
    new RecurringInvoiceValidator(new ItemValidator())
);

$recurringInvoiceEntity = new RecurringInvoiceEntity();
$recurringInvoiceEntity->customerId = 123;
$recurringInvoiceEntity->startDate = '2020-01-01';
$recurringInvoiceEntity->frequency = '2 weeks';
$recurringInvoiceEntity->outputType = 'draft';

$recurringInvoiceItem = new ItemEntity();
$recurringInvoiceItem->description = 'FastBill SDK Reccuring';
$recurringInvoiceItem->unitPrice = 1337;
$recurringInvoiceItem->vatPercent = 19;
$recurringInvoiceEntity->items[] = $recurringInvoiceItem;
$recurringInvoiceEntity->items[] = $recurringInvoiceItem;

$result = $recurringInvoiceService->createRecurringInvoice($recurringInvoiceEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
