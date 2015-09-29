<?php

namespace ju1ius\WebpackAssetsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class Ju1iusWebpackAssetsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->registerAssetHelper($config, $container);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    private function registerAssetHelper($config, ContainerBuilder $container)
    {
        $assetHelper = new Definition('ju1ius\WebpackAssetsBundle\Helper\AssetHelper', [
            $config['revision_manifest']
        ]);
        $assetHelper->setPublic(false);
        $container->setDefinition('ju1ius_webpack_assets.asset_helper', $assetHelper);
    }
}
