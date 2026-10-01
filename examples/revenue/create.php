<?php
declare(strict_types=1);

namespace FastBillSdk\Revenue;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new ApiClient($username, $apiKey);

$revenueService = new RevenueService($fastBillClient, new XmlService(), new RevenueValidator());

$entity = new RevenueEntity();
$entity->invoiceDate = '2026-01-01';
$entity->customerId = 1;
$entity->subTotal = 100;
$entity->vatTotal = 19;
$entity->comment = 'FastBill SDK';
$result = $revenueService->createRevenue($entity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
