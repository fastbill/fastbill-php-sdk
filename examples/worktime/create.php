<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';


$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$workTimesService = new FastBillSdk\WorkTime\WorkTimeService(
    $fastBillClient,
    new \FastBillSdk\Common\XmlService(),
    new \FastBillSdk\WorkTime\WorkTimeValidator()
);

$workTimeEntity = new \FastBillSdk\WorkTime\WorkTimeEntity();
$workTimeEntity->customerId = 123;
$workTimeEntity->projectId = 456;
$workTimeEntity->comment = 'sdk test';
$workTimeEntity->minutes = 30;

$result = $workTimesService->createTime($workTimeEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
die();
