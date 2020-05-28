<?php

namespace DevOpStudio\Bundle\CaptchaBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class CaptchaExtension extends Extension
{

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'devop_studio_captcha';
    }

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $key => $value) {
            $container->setParameter("devop_studio_captcha.{$key}", $value);
        }

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('twig.form.resources', array_merge([
            '@DevOpStudioCaptcha/captcha.html.twig'
        ], $container->getParameter('twig.form.resources')));
    }
}
