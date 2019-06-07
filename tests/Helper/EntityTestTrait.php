<?php declare(strict_types=1);

namespace FastBillSdkTest\Helper;

trait EntityTestTrait
{
    /**
     * @var array
     */
    protected $noticeMessages;

    public function disableDefaultErrorHandler(): void
    {
        set_error_handler(
            function ($errno, $errstr, $errfile, $errline) {
                $this->noticeMessages[] = $errstr;
            }
        );
    }

    public function activateDefaultErrorHandler(): void
    {
        $this->noticeMessages = [];
        restore_error_handler();
    }
}
