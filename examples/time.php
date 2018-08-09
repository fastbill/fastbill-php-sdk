<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

$username = '';
$apiKey = '';

$fastBillClient = new FastBillSdk\Api\ApiClient($username, $apiKey);

$workTimesService = new FastBillSdk\Worktimes\WorktimesService($fastBillClient, new \FastBillSdk\Common\XmlService());
$workTimesSearchStruct = new \FastBillSdk\Worktimes\WorktimesSearchStruct();
$workTimesSearchStruct->setCustomerIdFilter(123);
$result = $workTimesService->getTime($workTimesSearchStruct);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo'<pre>';
var_dump($result);
echo'</pre>';
die();
