<?php
declare(strict_types=1);

namespace FastBillSdkTest\Project;

use FastBillSdk\Project\ProjectEntity;
use FastBillSdk\Project\ProjectSearchStruct;
use FastBillSdk\Project\ProjectService;
use FastBillSdk\Project\ProjectValidator;
use FastBillSdkTest\Common\BaseTestTrait;
use PHPUnit\Framework\TestCase;

class ProjectServiceTest extends TestCase
{
    use BaseTestTrait;

    /**
     * @var ProjectService
     */
    private $projectService;

    public function getProjectService(): ProjectService
    {
        if (!$this->projectService) {
            $this->projectService = new ProjectService(
                $this->getApiClient(),
                $this->getXmlService(),
                new ProjectValidator()
            );
        }

        return $this->projectService;
    }

    public function testGetProject()
    {
        foreach ($this->getProjectService()->getProject(new ProjectSearchStruct()) as $project) {
            self::assertInstanceOf(ProjectEntity::class, $project);
        }
    }
}
