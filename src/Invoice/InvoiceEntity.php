<?php
declare(strict_types=1);

namespace FastBillSdk\Invoice;

use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\VatItemEntity;

class InvoiceEntity
{
    public $invoiceId;

    public $type;

    public $customerId;

    public $customerNumber;

    public $customerCostcenterId;

    public $projectId;

    public $organization;

    public $salutation;

    public $firstName;

    public $lastName;

    public $address;

    public $address2;

    public $zipcode;

    public $city;

    public $comment;

    /**
     * @var InvoiceCommentEntity[]|string
     */
    public $comments;

    public $paymentType;

    public $daysForPayment;

    public $bankName;

    public $bankAccountNumber;

    public $bankCode;

    public $bankAccountOwner;

    public $bankIban;

    public $bankBic;

    public $affiliate;

    public $countryCode;

    public $vatId;

    public $vatCase;

    public $currencyCode;

    public $templateId;

    public $contactId;

    public $subscriptionId;

    public $invoiceNumber;

    public $invoiceTitle;

    public $introText;

    public $note;

    public $paidDate;

    public $isCanceled;

    public $invoiceDate;

    public $dueDate;

    public $servicePeriodStart;

    public $servicePeriodEnd;

    public $deliveryDate;

    public $lastUpdate;

    public $cashDiscountPercent;

    public $cashDiscountDays;

    public $subTotal;

    public $vatTotal;

    /**
     * @var VatItemEntity[]|string
     */
    public $vatItems;

    /**
     * @var ItemEntity[]|string
     */
    public $items;

    public $total;

    /**
     * @var InvoicePaymentEntity[]|string
     */
    public $payments;

    public $paymentInfo;

    public $documentUrl;

    const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceId',
        'TYPE' => 'type',
        'CUSTOMER_ID' => 'customerId',
        'CUSTOMER_NUMBER' => 'customerNumber',
        'CUSTOMER_COSTCENTER_ID' => 'customerCostcenterId',
        'PROJECT_ID' => 'projectId',
        'ORGANIZATION' => 'organization',
        'SALUTATION' => 'salutation',
        'FIRST_NAME' => 'firstName',
        'LAST_NAME' => 'lastName',
        'ADDRESS' => 'address',
        'ADDRESS_2' => 'address2',
        'ZIPCODE' => 'zipcode',
        'CITY' => 'city',
        'COMMENT_' => 'comment',
        'COMMENTS' => 'comments',
        'PAYMENT_TYPE' => 'paymentType',
        'DAYS_FOR_PAYMENT' => 'daysForPayment',
        'BANK_NAME' => 'bankName',
        'BANK_ACCOUNT_NUMBER' => 'bankAccountNumber',
        'BANK_CODE' => 'bankCode',
        'BANK_ACCOUNT_OWNER' => 'bankAccountOwner',
        'BANK_IBAN' => 'bankIban',
        'BANK_BIC' => 'bankBic',
        'AFFILIATE' => 'affiliate',
        'COUNTRY_CODE' => 'countryCode',
        'VAT_ID' => 'vatId',
        'VAT_CASE' => 'vatCase',
        'CURRENCY_CODE' => 'currencyCode',
        'TEMPLATE_ID' => 'templateId',
        'CONTACT_ID' => 'contactId',
        'SUBSCRIPTION_ID' => 'subscriptionId',
        'INVOICE_NUMBER' => 'invoiceNumber',
        'INVOICE_TITLE' => 'invoiceTitle',
        'INTROTEXT' => 'introText',
        'NOTE' => 'note',
        'PAID_DATE' => 'paidDate',
        'IS_CANCELED' => 'isCanceled',
        'INVOICE_DATE' => 'invoiceDate',
        'DUE_DATE' => 'dueDate',
        'SERVICE_PERIOD_START' => 'servicePeriodStart',
        'SERVICE_PERIOD_END' => 'servicePeriodEnd',
        'DELIVERY_DATE' => 'deliveryDate',
        'LASTUPDATE' => 'lastUpdate',
        'CASH_DISCOUNT_PERCENT' => 'cashDiscountPercent',
        'CASH_DISCOUNT_DAYS' => 'cashDiscountDays',
        'SUB_TOTAL' => 'subTotal',
        'VAT_TOTAL' => 'vatTotal',
        'VAT_ITEMS' => 'vatItems',
        'ITEMS' => 'items',
        'TOTAL' => 'total',
        'PAYMENTS' => 'payments',
        'PAYMENT_INFO' => 'paymentInfo',
        'DOCUMENT_URL' => 'documentUrl',
    ];

    const XML_FIELD_MAPPING = [
        'invoiceId' => 'INVOICE_ID',
        'type' => 'TYPE',
        'customerId' => 'CUSTOMER_ID',
        'customerNumber' => 'CUSTOMER_NUMBER',
        'customerCostcenterId' => 'CUSTOMER_COSTCENTER_ID',
        'projectId' => 'PROJECT_ID',
        'organization' => 'ORGANIZATION',
        'salutation' => 'SALUTATION',
        'firstName' => 'FIRST_NAME',
        'lastName' => 'LAST_NAME',
        'address' => 'ADDRESS',
        'address2' => 'ADDRESS_2',
        'zipcode' => 'ZIPCODE',
        'city' => 'CITY',
        'comment' => 'COMMENT_',
        'comments' => 'COMMENTS',
        'paymentType' => 'PAYMENT_TYPE',
        'daysForPayment' => 'DAYS_FOR_PAYMENT',
        'bankName' => 'BANK_NAME',
        'bankAccountNumber' => 'BANK_ACCOUNT_NUMBER',
        'bankCode' => 'BANK_CODE',
        'bankAccountOwner' => 'BANK_ACCOUNT_OWNER',
        'bankIban' => 'BANK_IBAN',
        'bankBic' => 'BANK_BIC',
        'affiliate' => 'AFFILIATE',
        'countryCode' => 'COUNTRY_CODE',
        'vatId' => 'VAT_ID',
        'vatCase' => 'VAT_CASE',
        'currencyCode' => 'CURRENCY_CODE',
        'templateId' => 'TEMPLATE_ID',
        'contactId' => 'CONTACT_ID',
        'subscriptionId' => 'SUBSCRIPTION_ID',
        'invoiceNumber' => 'INVOICE_NUMBER',
        'invoiceTitle' => 'INVOICE_TITLE',
        'introText' => 'INTROTEXT',
        'note' => 'NOTE',
        'paidDate' => 'PAID_DATE',
        'isCanceled' => 'IS_CANCELED',
        'invoiceDate' => 'INVOICE_DATE',
        'dueDate' => 'DUE_DATE',
        'servicePeriodStart' => 'SERVICE_PERIOD_START',
        'servicePeriodEnd' => 'SERVICE_PERIOD_END',
        'deliveryDate' => 'DELIVERY_DATE',
        'lastUpdate' => 'LASTUPDATE',
        'cashDiscountPercent' => 'CASH_DISCOUNT_PERCENT',
        'cashDiscountDays' => 'CASH_DISCOUNT_DAYS',
        'subTotal' => 'SUB_TOTAL',
        'vatTotal' => 'VAT_TOTAL',
        'vatItems' => 'VAT_ITEMS',
        'items' => 'ITEMS',
        'total' => 'TOTAL',
        'payments' => 'PAYMENTS',
        'paymentInfo' => 'PAYMENT_INFO',
        'documentUrl' => 'DOCUMENT_URL',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return InvoiceEntity
     */
    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                trigger_error('the provided xml key ' . $key . ' is not mapped at the moment in ' . self::class);
                continue;
            }

            switch ($key) {
                case 'COMMENTS':
                    $comments = [];
                    foreach ($value as $comment) {
                        $comments[] = new InvoiceCommentEntity($comment);
                    }

                    $this->comments = $comments;
                    break;
                case 'ITEMS':
                    $items = [];
                    foreach ($value as $item) {
                        $items[] = new ItemEntity($item);
                    }

                    $this->items = $items;
                    break;
                case 'VAT_ITEMS':
                    $vatItems = [];
                    foreach ($value as $vatItem) {
                        $vatItems[] = new VatItemEntity($vatItem);
                    }

                    $this->vatItems = $vatItems;
                    break;
                case 'PAYMENTS':
                    $payments = [];
                    foreach ($value as $payment) {
                        $payments[] = new InvoicePaymentEntity($payment);
                    }

                    $this->payments = $payments;
                    break;
                default:
                    $this->{self::FIELD_MAPPING[$key]} = (string) $value;
                    break;
            }
        }

        return $this;
    }

    public function getXmlData(): array
    {
        $xmlData = [];
        foreach (self::XML_FIELD_MAPPING as $key => $value) {
            if ($this->$key && $key === 'items') {
                foreach ($this->items as $item) {
                    $xmlData[$value][] = $item->getXmlData();
                }
            } elseif ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
