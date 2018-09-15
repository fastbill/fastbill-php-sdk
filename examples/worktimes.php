<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

$username = 'user@example.com';
$apiKey = '123123123';

$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$workTimesService = new FastBillSdk\Worktimes\WorktimesService(
    $fastBillClient,
    new \FastBillSdk\Common\XmlService(),
    new \FastBillSdk\Worktimes\WorktimesValidator()
);
$workTimesSearchStruct = new \FastBillSdk\Worktimes\WorktimesSearchStruct();
$workTimesSearchStruct->setCustomerIdFilter(123123);
//$result = $workTimesService->getTime($workTimesSearchStruct);
$workTimeEntity = new \FastBillSdk\Worktimes\WorktimesEntity();
$workTimeEntity->customerId = 123;
$workTimeEntity->projectId = 456;
$workTimeEntity->comment = 'sdk test';
$workTimeEntity->minutes = 30;
$workTimeEntity->startTime = '0000-00-00 00:00:00';

$result = $workTimesService->createTime($workTimeEntity);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
die();
