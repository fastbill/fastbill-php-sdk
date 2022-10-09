<?php
declare(strict_types=1);

namespace FastBillSdk\Contact;

class ContactEntity
{
    public $contactId;

    public $customerId;

    public $organization;

    public $position;

    public $academicDegree;

    public $salutation;

    public $firstName;

    public $lastName;

    public $address;

    public $address2;

    public $zipCode;

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

    public $created;

    public $lastUpdate;

    public $tags;

    public $comment;

    public const FIELD_MAPPING = [
        'CONTACT_ID' => 'contactId',
        'CUSTOMER_ID' => 'customerId',
        'ORGANIZATION' => 'organization',
        'POSITION' => 'position',
        'ACADEMIC_DEGREE' => 'academicDegree',
        'SALUTATION' => 'salutation',
        'FIRST_NAME' => 'firstName',
        'LAST_NAME' => 'lastName',
        'ADDRESS' => 'address',
        'ADDRESS_2' => 'address2',
        'ZIPCODE' => 'zipCode',
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
        'CREATED' => 'created',
        'LASTUPDATE' => 'lastUpdate',
        'TAGS' => 'tags',
        'COMMENT' => 'comment',
    ];

    public const XML_FIELD_MAPPING = [
        'contactId' => 'CONTACT_ID',
        'customerId' => 'CUSTOMER_ID',
        'organization' => 'ORGANIZATION',
        'position' => 'POSITION',
        'academicDegree' => 'ACADEMIC_DEGREE',
        'salutation' => 'SALUTATION',
        'firstName' => 'FIRST_NAME',
        'lastName' => 'LAST_NAME',
        'address' => 'ADDRESS',
        'address2' => 'ADDRESS_2',
        'zipCode' => 'ZIPCODE',
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
        'created' => 'CREATED',
        'lastUpdate' => 'LASTUPDATE',
        'tags' => 'TAGS',
        'comment' => 'COMMENT',
    ];

    public function __construct(\SimpleXMLElement $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
    }

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
