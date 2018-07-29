<?php declare(strict_types=1);

namespace FastBillSdk\Common;

abstract class AbstractSearchStruct
{
    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }
}
