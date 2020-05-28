<?php

namespace DevOpStudio\Bundle\CaptchaBundle\Form\Type;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use DevOpStudio\Bundle\CaptchaBundle\Validator\Constraints\Captcha;

class CaptchaType extends AbstractType
{

    /**
     * @var string
     */
    private $siteKey;

    public function __construct(string $siteKey)
    {
        $this->siteKey = $siteKey;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['sitekey'] = $this->siteKey;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('constraints', [
            new Captcha(),
        ]);
    }

    public function getParent()
    {
        return TextType::class;
    }
}
