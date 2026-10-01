<?php
declare(strict_types=1);

namespace FastBillSdk\Revenue;

use FastBillSdk\Invoice\InvoicePaymentEntity;
use FastBillSdk\Item\ItemEntity;
use FastBillSdk\Item\VatItemEntity;

class RevenueEntity
{
    public $invoiceId;

    public $type;

    public $subType;

    public $customerId;

    public $contactId;

    public $customerNumber;

    public $customerCostcenterId;

    public $projectId;

    public $currencyCode;

    public $isGross;

    public $deliveryDate;

    public $invoiceTitle;

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

    /**
     * @var InvoicePaymentEntity[]|string
     */
    public $payments;

    public $total;

    public $organization;

    public $salutation;

    public $firstName;

    public $lastName;

    public $address;

    public $address2;

    public $zipcode;

    public $city;

    public $paymentType;

    public $bankName;

    public $bankAccountNumber;

    public $bankCode;

    public $bankAccountOwner;

    public $bankIban;

    public $bankBic;

    public $comments;

    public $comment;

    public $countryCode;

    public $vatId;

    public $templateId;

    public $invoiceNumber;

    public $introtext;

    public $paidDate;

    public $isCanceled;

    public $invoiceDate;

    public $dueDate;

    public $paymentInfo;

    public $lastupdate;

    public $documentUrl;

    public $baseCurrencyCode;

    public $exchangeRate;

    public const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceId',
        'TYPE' => 'type',
        'SUBTYPE' => 'subType',
        'CUSTOMER_ID' => 'customerId',
        'CONTACT_ID' => 'contactId',
        'CUSTOMER_NUMBER' => 'customerNumber',
        'CUSTOMER_COSTCENTER_ID' => 'customerCostcenterId',
        'PROJECT_ID' => 'projectId',
        'CURRENCY_CODE' => 'currencyCode',
        'IS_GROSS' => 'isGross',
        'DELIVERY_DATE' => 'deliveryDate',
        'INVOICE_TITLE' => 'invoiceTitle',
        'CASH_DISCOUNT_PERCENT' => 'cashDiscountPercent',
        'CASH_DISCOUNT_DAYS' => 'cashDiscountDays',
        'SUB_TOTAL' => 'subTotal',
        'VAT_TOTAL' => 'vatTotal',
        'VAT_ITEMS' => 'vatItems',
        'ITEMS' => 'items',
        'PAYMENTS' => 'payments',
        'TOTAL' => 'total',
        'ORGANIZATION' => 'organization',
        'SALUTATION' => 'salutation',
        'FIRST_NAME' => 'firstName',
        'LAST_NAME' => 'lastName',
        'ADDRESS' => 'address',
        'ADDRESS_2' => 'address2',
        'ZIPCODE' => 'zipcode',
        'CITY' => 'city',
        'PAYMENT_TYPE' => 'paymentType',
        'BANK_NAME' => 'bankName',
        'BANK_ACCOUNT_NUMBER' => 'bankAccountNumber',
        'BANK_CODE' => 'bankCode',
        'BANK_ACCOUNT_OWNER' => 'bankAccountOwner',
        'BANK_IBAN' => 'bankIban',
        'BANK_BIC' => 'bankBic',
        'COMMENTS' => 'comments',
        'COMMENT' => 'comment',
        'COUNTRY_CODE' => 'countryCode',
        'VAT_ID' => 'vatId',
        'TEMPLATE_ID' => 'templateId',
        'INVOICE_NUMBER' => 'invoiceNumber',
        'INTROTEXT' => 'introtext',
        'PAID_DATE' => 'paidDate',
        'IS_CANCELED' => 'isCanceled',
        'INVOICE_DATE' => 'invoiceDate',
        'DUE_DATE' => 'dueDate',
        'PAYMENT_INFO' => 'paymentInfo',
        'LASTUPDATE' => 'lastupdate',
        'DOCUMENT_URL' => 'documentUrl',
        'BASE_CURRENCY_CODE' => 'baseCurrencyCode',
        'EXCHANGE_RATE' => 'exchangeRate',
    ];

    public const XML_FIELD_MAPPING = [
        'invoiceId' => 'INVOICE_ID',
        'type' => 'TYPE',
        'subType' => 'SUBTYPE',
        'customerId' => 'CUSTOMER_ID',
        'contactId' => 'CONTACT_ID',
        'customerNumber' => 'CUSTOMER_NUMBER',
        'customerCostcenterId' => 'CUSTOMER_COSTCENTER_ID',
        'projectId' => 'PROJECT_ID',
        'currencyCode' => 'CURRENCY_CODE',
        'isGross' => 'IS_GROSS',
        'deliveryDate' => 'DELIVERY_DATE',
        'invoiceTitle' => 'INVOICE_TITLE',
        'cashDiscountPercent' => 'CASH_DISCOUNT_PERCENT',
        'cashDiscountDays' => 'CASH_DISCOUNT_DAYS',
        'subTotal' => 'SUB_TOTAL',
        'vatTotal' => 'VAT_TOTAL',
        'vatItems' => 'VAT_ITEMS',
        'items' => 'ITEMS',
        'payments' => 'PAYMENTS',
        'total' => 'TOTAL',
        'organization' => 'ORGANIZATION',
        'salutation' => 'SALUTATION',
        'firstName' => 'FIRST_NAME',
        'lastName' => 'LAST_NAME',
        'address' => 'ADDRESS',
        'address2' => 'ADDRESS_2',
        'zipcode' => 'ZIPCODE',
        'city' => 'CITY',
        'paymentType' => 'PAYMENT_TYPE',
        'bankName' => 'BANK_NAME',
        'bankAccountNumber' => 'BANK_ACCOUNT_NUMBER',
        'bankCode' => 'BANK_CODE',
        'bankAccountOwner' => 'BANK_ACCOUNT_OWNER',
        'bankIban' => 'BANK_IBAN',
        'bankBic' => 'BANK_BIC',
        'comments' => 'COMMENTS',
        'comment' => 'COMMENT',
        'countryCode' => 'COUNTRY_CODE',
        'vatId' => 'VAT_ID',
        'templateId' => 'TEMPLATE_ID',
        'invoiceNumber' => 'INVOICE_NUMBER',
        'introtext' => 'INTROTEXT',
        'paidDate' => 'PAID_DATE',
        'isCanceled' => 'IS_CANCELED',
        'invoiceDate' => 'INVOICE_DATE',
        'dueDate' => 'DUE_DATE',
        'paymentInfo' => 'PAYMENT_INFO',
        'lastupdate' => 'LASTUPDATE',
        'documentUrl' => 'DOCUMENT_URL',
        'baseCurrencyCode' => 'BASE_CURRENCY_CODE',
        'exchangeRate' => 'EXCHANGE_RATE',
    ];

    public function __construct(?\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                continue;
            }

            switch ($key) {
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
            if ($key === 'vatItems' || $key === 'payments') {
                // response only
                continue;
            }

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
