<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

function lowerCamelCase($string)
{
    $string = mb_strtolower($string);
    $string = ucwords($string, '_');
    $string[0] = mb_strtolower($string[0]);
    $string = str_replace('_', '', $string);

    return $string;
}

require_once __DIR__ . '/credentials.php';
require_once __DIR__ . '/../vendor/autoload.php';

/*
foreach (\FastBillSdk\Estimate\EstimateEntity::FIELD_MAPPING as $key => $value) {
    echo "'$value' => '$key',<br/>";
}

die();*/

$fields = 'VAT_PERCENT
COMPLETE_NET
VAT_VALUE';

foreach (explode("\n", $fields) as $value) {
    echo 'public $' . lowerCamelCase($value) . ';' . '<br /><br />';
}

echo ' const FIELD_MAPPING = [<br/>';
foreach (explode("\n", $fields) as $value) {
    echo '\'' . $value . '\' => \'' . lowerCamelCase($value) . '\',<br />';
}
echo '];<br /><br />';

echo ' const XML_FIELD_MAPPING = [<br/>';
foreach (\FastBillSdk\Invoice\InvoiceEntity::FIELD_MAPPING as $key => $value) {
    echo '\'' . $value . '\' => \'' . $key . '\',<br />';
}
echo '];<br /><br />';
