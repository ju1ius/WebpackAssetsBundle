<?php

namespace ju1ius\WebpackAssetsBundle\Tests\DependencyInjection;

use ju1ius\WebpackAssetsBundle\DependencyInjection\Ju1iusWebpackAssetsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Ju1iusWebpackAssetsExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder;
     */
    private $container;

    /**
     * @var Ju1iusWebpackAssetsExtension;
     */
    private $extension;

    public function testLoadWithDefaults()
    {
        $this->extension->load(array(), $this->container);

        $this->assertTrue($this->container->hasDefinition('ju1ius_webpack_assets.asset_helper'));
        $this->assertEquals(
            array(
                '%kernel.root_dir%/../webpack-assets.json'
            ),
            $this->container->getDefinition('ju1ius_webpack_assets.asset_helper')->getArguments()
        );
    }

    public function testLoadWithCustomConfig()
    {
        $this->extension->load(
            array(
                'ju1ius_webpack_assets' => array(
                    'revision_manifest' => 'rev-manifest.json'
                )
            ),
            $this->container
        );

        $this->assertEquals(
            array(
                'rev-manifest.json'
            ),
            $this->container->getDefinition('ju1ius_webpack_assets.asset_helper')->getArguments()
        );
    }

    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new Ju1iusWebpackAssetsExtension();
    }

    protected function tearDown()
    {
        unset($this->container, $this->extension);
    }
}
