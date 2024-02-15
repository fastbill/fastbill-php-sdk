<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$productService = new FastBillSdk\Product\ProductService(
    $fastBillClient,
    new FastBillSdk\Common\XmlService(),
    new FastBillSdk\Product\ProductValidator()
);

$entity = new FastBillSdk\Product\ProductEntity();
$entity->title = 'FastBill SDK';
$entity->unitPrice = 1337;
$entity->articleNumber = 222;
$entity->vatPercent = 19;
$entity->isGross = 1;

$result = $productService->createProduct($entity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit;
