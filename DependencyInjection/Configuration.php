<?php

namespace ju1ius\WebpackAssetsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ju1ius_webpack_assets');

        $rootNode->children()
            ->scalarNode('revision_manifest')
                ->cannotBeEmpty()
                ->defaultValue('%kernel.root_dir%/../webpack-assets.json')
            ->end()
        ->end();

        return $treeBuilder;
    }
}
