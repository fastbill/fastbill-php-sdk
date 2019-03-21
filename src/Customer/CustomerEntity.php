<?php declare(strict_types=1);

namespace FastBillSdk\Customer;

class CustomerEntity
{
    const CUSTOMER_TYPE_CONSUMER = 'consumer';

    const CUSTOMER_TYPE_BUSINESS = 'business';

    public $customerId;

    public $customerNumber;

    public $daysForPayment;

    public $created;

    public $paymentType;

    public $bankName;

    public $bankAccountNumber;

    public $bankCode;

    public $bankAccountOwner;

    public $bankIban;

    public $bankBic;

    public $bankAccountMandateReference;

    public $showPaymentNotice;

    public $accountReceivable;

    public $customerType;

    public $top;

    public $newsletterOptin;

    public $organization;

    public $position;

    public $academicDegree;

    public $salutation;

    public $firstName;

    public $lastName;

    public $address;

    public $address2;

    public $zipcode;

    public $city;

    public $countryCode;

    public $secondaryAddress;

    public $phone;

    public $phone2;

    public $fax;

    public $mobile;

    public $email;

    public $website;

    public $vatId;

    public $currencyCode;

    public $lastupdate;

    public $tags;

    const FIELD_MAPPING = [
        'CUSTOMER_ID' => 'customerId',
        'CUSTOMER_NUMBER' => 'customerNumber',
        'DAYS_FOR_PAYMENT' => 'daysForPayment',
        'CREATED' => 'created',
        'PAYMENT_TYPE' => 'paymentType',
        'BANK_NAME' => 'bankName',
        'BANK_ACCOUNT_NUMBER' => 'bankAccountNumber',
        'BANK_CODE' => 'bankCode',
        'BANK_ACCOUNT_OWNER' => 'bankAccountOwner',
        'BANK_IBAN' => 'bankIban',
        'BANK_BIC' => 'bankBic',
        'BANK_ACCOUNT_MANDATE_REFERENCE' => 'bankAccountMandateReference',
        'SHOW_PAYMENT_NOTICE' => 'showPaymentNotice',
        'ACCOUNT_RECEIVABLE' => 'accountReceivable',
        'CUSTOMER_TYPE' => 'customerType',
        'TOP' => 'top',
        'NEWSLETTER_OPTIN' => 'newsletterOptin', // deprecated
        'ORGANIZATION' => 'organization',
        'POSITION' => 'position',
        'ACADEMIC_DEGREE' => 'academicDegree',
        'SALUTATION' => 'salutation',
        'FIRST_NAME' => 'firstName',
        'LAST_NAME' => 'lastName',
        'ADDRESS' => 'address',
        'ADDRESS_2' => 'address2',
        'ZIPCODE' => 'zipcode',
        'CITY' => 'city',
        'COUNTRY_CODE' => 'countryCode',
        'SECONDARY_ADDRESS' => 'secondaryAddress',
        'PHONE' => 'phone',
        'PHONE_2' => 'phone2',
        'FAX' => 'fax',
        'MOBILE' => 'mobile',
        'EMAIL' => 'email',
        'WEBSITE' => 'website',
        'VAT_ID' => 'vatId',
        'CURRENCY_CODE' => 'currencyCode',
        'LASTUPDATE' => 'lastupdate',
        'TAGS' => 'tags',
    ];

    const XML_FIELD_MAPPING = [
        'customerId' => 'CUSTOMER_ID',
        'customerNumber' => 'CUSTOMER_NUMBER',
        'daysForPayment' => 'DAYS_FOR_PAYMENT',
        'created' => 'CREATED',
        'paymentType' => 'PAYMENT_TYPE',
        'bankName' => 'BANK_NAME',
        'bankAccountNumber' => 'BANK_ACCOUNT_NUMBER',
        'bankCode' => 'BANK_CODE',
        'bankAccountOwner' => 'BANK_ACCOUNT_OWNER',
        'bankIban' => 'BANK_IBAN',
        'bankBic' => 'BANK_BIC',
        'bankAccountMandateReference' => 'BANK_ACCOUNT_MANDATE_REFERENCE',
        'showPaymentNotice' => 'SHOW_PAYMENT_NOTICE',
        'accountReceivable' => 'ACCOUNT_RECEIVABLE',
        'customerType' => 'CUSTOMER_TYPE',
        'top' => 'TOP',
        'newsletterOptin' => 'NEWSLETTER_OPTIN',
        'organization' => 'ORGANIZATION',
        'position' => 'POSITION',
        'academicDegree' => 'ACADEMIC_DEGREE',
        'salutation' => 'SALUTATION',
        'firstName' => 'FIRST_NAME',
        'lastName' => 'LAST_NAME',
        'address' => 'ADDRESS',
        'address2' => 'ADDRESS_2',
        'zipcode' => 'ZIPCODE',
        'city' => 'CITY',
        'countryCode' => 'COUNTRY_CODE',
        'secondaryAddress' => 'SECONDARY_ADDRESS',
        'phone' => 'PHONE',
        'phone2' => 'PHONE_2',
        'fax' => 'FAX',
        'mobile' => 'MOBILE',
        'email' => 'EMAIL',
        'website' => 'WEBSITE',
        'vatId' => 'VAT_ID',
        'currencyCode' => 'CURRENCY_CODE',
        'lastupdate' => 'LASTUPDATE',
        'tags' => 'TAGS',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @return CustomerEntity
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

    public function getXmlData(): array
    {
        $xmlData = [];
        foreach (self::XML_FIELD_MAPPING as $key => $value) {
            if ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
