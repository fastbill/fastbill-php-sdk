<?php declare(strict_types=1);

namespace FastBillSdk\Common;

class XmlService
{
    /**
     * @var \SimpleXMLElement
     */
    private $simpleXml;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var string
     */
    private $service;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset = -1;

    /**
     * @var array
     */
    private $data;

    public function __construct()
    {
        $this->simpleXml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><FBAPI></FBAPI>', 0, false);
    }

    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function getXml(): string
    {
        $this->simpleXml->addChild('SERVICE', $this->service);

        $this->addFilters();
        $this->addData();
        $this->addLimitAndOffset();

        return $this->simpleXml->asXML();
    }

    public function setService(string $service)
    {
        // reset xml to the base
        $this->__construct();
        $this->service = $service;
    }

    private function addFilters()
    {
        if ($this->filters) {
            $filter = $this->simpleXml->addChild('FILTER');
            foreach ($this->filters as $filterName => $filterValue) {
                $filter->addChild($filterName, (string) $filterValue);
            }
        }
    }

    private function addData()
    {
        if ($this->data) {
            $data = $this->simpleXml->addChild('DATA');
            foreach ($this->data as $key => $value) {
                if (\is_array($value)) {
                    $child = $data->addChild($key);
                    foreach ($value as $children) {
                        switch ($key) {
                            case 'ITEMS':
                                $item = $child->addChild('ITEM');
                                foreach ($children as $childKey => $childValue) {
                                    $item->addChild($childKey, (string) $childValue);
                                }
                                break;
                            case 'RECIPIENT':
                                foreach ($children as $childKey => $childValue) {
                                    $child->addChild($childKey, (string) $childValue);
                                }
                                break;
                        }
                    }
                } else {
                    $data->addChild($key, (string) $value);
                }
            }
        }
    }

    private function addLimitAndOffset()
    {
        if ($this->limit) {
            $this->simpleXml->addChild('LIMIT', (string) $this->limit);
        }

        if ($this->offset >= 0) {
            $this->simpleXml->addChild('OFFSET', (string) $this->offset);
        }
    }
}
