<?php

namespace DevOpStudio\Bundle\CaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DevOpStudio\Bundle\CaptchaBundle\Util\CaptchaVerify;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CaptchaValidator extends ConstraintValidator
{

    /**
     * @var CaptchaVerify
     */
    private $captchaVerify;

    /**
     * CaptchaValidator constructor.
     *
     * @param CaptchaVerify $captchaVerify
     */
    public function __construct(CaptchaVerify $captchaVerify)
    {
        $this->captchaVerify = $captchaVerify;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {

        if (!$constraint instanceof Captcha) {
            throw new UnexpectedTypeException($constraint, Captcha::class);
        }

        if (!$this->captchaVerify->validate()) {
            $this->context->buildViolation($constraint->message)
                ->setCode(Captcha::INVALID_CAPTCHA)
                ->addViolation();

            return;
        }
    }
}
