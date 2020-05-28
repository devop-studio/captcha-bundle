<?php

namespace DevOpStudio\Bundle\CaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Captcha extends Constraint
{
    const INVALID_CAPTCHA = '0f1517a5-0552-4f5d-93f5-4ec05760e899';

    protected static $errorNames = [
        self::INVALID_CAPTCHA => 'Wrong or invalid captcha',
    ];

    public $message = 'Invalid captcha. Please try again.';

    public function validatedBy()
    {
        return 'devop_studio_captcha.validator';
    }
}
