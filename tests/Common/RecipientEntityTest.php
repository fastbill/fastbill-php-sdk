<?php declare(strict_types=1);

namespace FastBillSdkTest\Common;

use FastBillSdk\Common\RecipientEntity;
use PHPUnit\Framework\TestCase;

class RecipientEntityTest extends TestCase
{
    public function testToEmailAddress(): void
    {
        $entity = new RecipientEntity();
        $entity->setToEmailAddress('test@example.com');

        self::assertEquals('test@example.com', $entity->getToEmailAddress());
    }

    public function testCcEmailAddress(): void
    {
        $entity = new RecipientEntity();
        $entity->setCcEmailAddress('test@example.com');

        self::assertEquals('test@example.com', $entity->getCcEmailAddress());
    }

    public function testBccEmailAddress(): void
    {
        $entity = new RecipientEntity();
        $entity->setBccEmailAddress('test@example.com');

        self::assertEquals('test@example.com', $entity->getBccEmailAddress());
    }

    public function testToEmailAddressWithInvalidEmailAddress(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $entity = new RecipientEntity();
        $entity->setToEmailAddress('invalid-email@');
    }

    public function testCcEmailAddressWithInvalidEmailAddress(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $entity = new RecipientEntity();
        $entity->setCcEmailAddress('invalid-email@');
    }

    public function testBccEmailAddressWithInvalidEmailAddress(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $entity = new RecipientEntity();
        $entity->setBccEmailAddress('invalid-email@');
    }

    public function testApplyEmails(): void
    {
        $entity = new RecipientEntity();
        $entity->setToEmailAddress('to@example.com');
        $entity->setCcEmailAddress('cc@example.com');
        $entity->setBccEmailAddress('bcc@example.com');

        $array = [];
        $entity->applyEmails($array);

        $expectedArray['RECIPIENT'][] = ['TO' => 'to@example.com'];
        $expectedArray['RECIPIENT'][] = ['CC' => 'cc@example.com'];
        $expectedArray['RECIPIENT'][] = ['BCC' => 'bcc@example.com'];

        self::assertEquals(
            $expectedArray,
            $array
        );
    }
}
