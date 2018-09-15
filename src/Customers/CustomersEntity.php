<?php declare(strict_types=1);

namespace FastBillSdk\Customers;

class CustomersEntity
{
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

    public $secondaryAddres;

    public $phone;

    public $phone2;

    public $fax;

    public $mobile;

    public $email;

    public $website;

    public $vatId;

    public $currencyCode;

    public $pastupdate;

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
        'SECONDARY_ADDRES' => 'secondaryAddres', // ??? typo
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

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

    /**
     * @param \SimpleXMLElement $data
     * @return CustomersEntity
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
