<?php
declare(strict_types=1);

namespace FastBillSdk\Product;

use FastBillSdk\Common\AbstractSearchStruct;

class ProductSearchStruct extends AbstractSearchStruct
{
    public function setArticleNumberFilter(string $articleNumber)
    {
        $this->filters['ARTICLE_NUMBER'] = $articleNumber;
    }
}
