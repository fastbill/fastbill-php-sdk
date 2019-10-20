<?php declare(strict_types=1);

namespace FastBillSdkTest\Common;

use FastBillSdk\Api\ApiClient;
use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\XmlService;
use FastBillSdkTest\Helper\ApiDummyClient;

trait BaseTestTrait
{
    public function getApiClient(): ApiClientInterface
    {
        return new ApiClient(getenv('USERNAME'), getenv('APIKEY'));
    }

    public function getApiDummyClient(): ApiClientInterface
    {
        return new ApiDummyClient();
    }

    public function getXmlService(): XmlService
    {
        return new XmlService();
    }
}
