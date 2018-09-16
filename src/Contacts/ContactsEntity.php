<?php declare(strict_types=1);

namespace FastBillSdk\Contacts;

class ContactsEntity
{
    public $contactId;

    public $customerId;

    public $organization;

    public $position;

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

    public $vatId;

    public $currencyCode;

    public $created;

    public $tags;

    const FIELD_MAPPING = [
        'CONTACT_ID' => 'contactId',
        'CUSTOMER_ID' => 'customerId',
        'ORGANIZATION' => 'organization',
        'POSITION' => 'position',
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
        'VAT_ID' => 'vatId',
        'CURRENCY_CODE' => 'currencyCode',
        'CREATED' => 'created',
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
     * @return ContactsEntity
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
