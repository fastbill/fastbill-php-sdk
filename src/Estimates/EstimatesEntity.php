<?php declare(strict_types=1);

namespace FastBillSdk\Estimates;

class EstimatesEntity
{
    public $estimateId;

    public $state;

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

    public $paymentType;

    public $bankName;

    public $bankAccountNumber;

    public $bankCode;

    public $bankAccountOwner;

    public $bankIban;

    public $bankBic;

    public $countryCode;

    public $vatId;

    public $currencyCode;

    public $templateId;

    public $estimateNumber;

    public $introtext;

    public $estimateDate;

    public $dueDate;

    public $subTotal;

    public $vatTotal;

    public $vatItems;

    public $items;

    public $total;

    public $documentUrl;

    const FIELD_MAPPING = [
        'ESTIMATE_ID' => 'estimateId',
        'STATE' => 'state',
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
        'PAYMENT_TYPE' => 'paymentType',
        'BANK_NAME' => 'bankName',
        'BANK_ACCOUNT_NUMBER' => 'bankAccountNumber',
        'BANK_CODE' => 'bankCode',
        'BANK_ACCOUNT_OWNER' => 'bankAccountOwner',
        'BANK_IBAN' => 'bankIban',
        'BANK_BIC' => 'bankBic',
        'COUNTRY_CODE' => 'countryCode',
        'VAT_ID' => 'vatId',
        'CURRENCY_CODE' => 'currencyCode',
        'TEMPLATE_ID' => 'templateId',
        'ESTIMATE_NUMBER' => 'estimateNumber',
        'INTROTEXT' => 'introtext',
        'ESTIMATE_DATE' => 'estimateDate',
        'DUE_DATE' => 'dueDate',
        'SUB_TOTAL' => 'subTotal',
        'VAT_TOTAL' => 'vatTotal',
        'VAT_ITEMS' => 'vatItems',
        'ITEMS' => 'items',
        'TOTAL' => 'total',
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
     * @return EstimatesEntity
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
