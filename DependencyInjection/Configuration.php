<?php

namespace DevOpStudio\Bundle\CaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder('captcha');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('sitekey')->isRequired()->end()
            ->scalarNode('secret')->isRequired()->end()
            ->scalarNode('template')->defaultValue('@DevOpStudio/captcha.html.twig')->end()
            ->end();

        return $treeBuilder;
    }
}
