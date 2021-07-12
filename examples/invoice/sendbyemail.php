<?php
declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Common\XmlService;
use FastBillSdk\Item\ItemValidator;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../credentials.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$fastBillClient = new ApiClient($username, $apiKey);

$invoiceService = new InvoiceService(
    $fastBillClient,
    new XmlService(),
    new InvoiceValidator(new ItemValidator())
);

$invoiceEntity = new InvoiceEntity();
$invoiceEntity->invoiceId = 16462410;

$recipient = new \FastBillSdk\Common\RecipientEntity();
$recipient->setToEmailAddress('test@example.com');

$subject = 'Invoice Subject';
$message = 'Here your the already discussed Invoice';

$result = $invoiceService->sendByEmailInvoice($invoiceEntity, $recipient, $subject, $message, false);

ini_set('xdebug.var_display_max_depth', '5');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
echo '<pre>';
var_dump($result);
echo '</pre>';
exit();
