<?php
declare(strict_types=1);

namespace FastBillSdk\Estimate;

class EstimateEntity
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

    public $invoiceTitle;

    public $introtext;

    public $estimateDate;

    public $dueDate;

    public $subTotal;

    public $vatTotal;

    /**
     * @var EstimateVatItemEntity[]|string
     */
    public $vatItems;

    /**
     * @var EstimateItemEntity[]|string
     */
    public $items;

    public $total;

    public $documentUrl;

    public const FIELD_MAPPING = [
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
        'INVOICE_TITLE' => 'invoiceTitle',
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

    public const XML_FIELD_MAPPING = [
        'estimateId' => 'ESTIMATE_ID',
        'state' => 'STATE',
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
        'paymentType' => 'PAYMENT_TYPE',
        'bankName' => 'BANK_NAME',
        'bankAccountNumber' => 'BANK_ACCOUNT_NUMBER',
        'bankCode' => 'BANK_CODE',
        'bankAccountOwner' => 'BANK_ACCOUNT_OWNER',
        'bankIban' => 'BANK_IBAN',
        'bankBic' => 'BANK_BIC',
        'countryCode' => 'COUNTRY_CODE',
        'vatId' => 'VAT_ID',
        'currencyCode' => 'CURRENCY_CODE',
        'templateId' => 'TEMPLATE_ID',
        'estimateNumber' => 'ESTIMATE_NUMBER',
        'invoiceTitle' => 'INVOICE_TITLE',
        'introtext' => 'INTROTEXT',
        'estimateDate' => 'ESTIMATE_DATE',
        'dueDate' => 'DUE_DATE',
        'subTotal' => 'SUB_TOTAL',
        'vatTotal' => 'VAT_TOTAL',
        'vatItems' => 'VAT_ITEMS',
        'items' => 'ITEMS',
        'total' => 'TOTAL',
        'documentUrl' => 'DOCUMENT_URL',
    ];

    public function __construct(?\SimpleXMLElement $data = null)
    {
        if ($data) {
            $items = [];
            foreach ($data->ITEMS->ITEM as $estimateItemEntity) {
                $items[] = new EstimateItemEntity($estimateItemEntity);
            }

            $vatItems = [];
            foreach ($data->VAT_ITEMS->VAT_ITEM as $estimateVatItemEntity) {
                $vatItems[] = new EstimateVatItemEntity($estimateVatItemEntity);
            }

            unset($data['ITEMS'], $data['VAT_ITEMS']);

            $this->setData($data);
            $this->items = $items;
            $this->vatItems = $vatItems;
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
            if ($this->$key && $key === 'items') {
                foreach ($this->items as $item) {
                    $xmlData[$value][] = $item->getXmlData();
                }
            } elseif ($this->$key && $key === 'vatItems') {
                foreach ($this->vatItems as $vatItem) {
                    $xmlData[$value][] = $vatItem->getXmlData();
                }
            } elseif ($this->$key) {
                $xmlData[$value] = $this->$key;
            }
        }

        return $xmlData;
    }
}
