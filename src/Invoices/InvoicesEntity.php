<?php declare(strict_types=1);

namespace FastBillSdk\Invoices;

class InvoicesEntity
{
    public $invoiceId;

    public $customerId;

    public $customerNumber;

    public $customerCostcenterId;

    public $organization;

    public $salutation;

    public $firstName;

    public $lastName;

    public $address;

    public $address2;

    public $zipcode;

    public $city;

    public $comment;

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

    public $currencyCode;

    public $templateId;

    public $contactId;

    public $subscriptionId;

    public $invoiceNumber;

    public $invoiceTitle;

    public $introtext;

    public $paidDate;

    public $isCanceled;

    public $invoiceDate;

    public $dueDate;

    public $deliveryDate;

    public $cashDiscountPercent;

    public $cashDiscountDays;

    public $subTotal;

    public $vatTotal;

    public $vatItems;

    public $items;

    public $total;

    public $payments;

    public $paymentInfo;

    public $documentUrl;

    const FIELD_MAPPING = [
        'INVOICE_ID' => 'invoiceId',
        'CUSTOMER_ID' => 'customerId',
        'CUSTOMER_NUMBER' => 'customerNumber',
        'CUSTOMER_COSTCENTER_ID' => 'customerCostcenterId',
        'ORGANIZATION' => 'organization',
        'SALUTATION' => 'salutation',
        'FIRST_NAME' => 'firstName',
        'LAST_NAME' => 'lastName',
        'ADDRESS' => 'address',
        'ADDRESS_2' => 'address2',
        'ZIPCODE' => 'zipcode',
        'CITY' => 'city',
        'COMMENT_' => 'comment',
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
        'CURRENCY_CODE' => 'currencyCode',
        'TEMPLATE_ID' => 'templateId',
        'CONTACT_ID' => 'contactId',
        'SUBSCRIPTION_ID' => 'subscriptionId',
        'INVOICE_NUMBER' => 'invoiceNumber',
        'INVOICE_TITLE' => 'invoiceTitle',
        'INTROTEXT' => 'introtext',
        'PAID_DATE' => 'paidDate',
        'IS_CANCELED' => 'isCanceled',
        'INVOICE_DATE' => 'invoiceDate',
        'DUE_DATE' => 'dueDate',
        'DELIVERY_DATE' => 'deliveryDate',
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

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @param \SimpleXMLElement $data
     * @return InvoicesEntity
     */
    public function setData(\SimpleXMLElement $data): self
    {
        foreach ($data as $key => $value) {
            if (!isset(self::FIELD_MAPPING[$key])) {
                trigger_error('the provided xml key ' . $key . ' is not mapped at the moment in ' . self::class);
                continue;
            }

            $this->{self::FIELD_MAPPING[$key]} = (string) $value;
        }

        return $this;
    }
}
