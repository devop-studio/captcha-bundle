<?php

namespace DevOpStudio\Bundle\CaptchaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use DevOpStudio\Bundle\CaptchaBundle\DependencyInjection\CaptchaExtension;

class DevOpStudioCaptchaBundle extends Bundle
{

    public function getContainerExtension()
    {
        return new CaptchaExtension();
    }
}
