<?php declare(strict_types=1);

namespace FastBillSdkTest\Template;

use FastBillSdk\Template\TemplateEntity;
use FastBillSdk\Template\TemplateService;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class TemplateServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var TemplateService
     */
    private $templateService;

    public function getTemplateService(): TemplateService
    {
        if (!$this->templateService) {
            $this->templateService = new TemplateService(
                $this->getApiClient(),
                $this->getXmlService()
            );
        }

        return $this->templateService;
    }

    public function testGetTemplate()
    {
        foreach ($this->getTemplateService()->getTemplate() as $template) {
            self::assertInstanceOf(TemplateEntity::class, $template);
        }
    }
}
