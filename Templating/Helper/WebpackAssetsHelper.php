<?php

namespace ju1ius\WebpackAssetsBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use ju1ius\WebpackAssetsBundle\Helper\AssetHelper;


class WebpackAssetsHelper extends Helper
{
    /**
     * @var AssetHelper
     */
    private $assetHelper;

    /**
     * @param AssetHelper $assetHelper
     */
    public function __construct(AssetHelper $assetHelper)
    {
        $this->assetHelper = $assetHelper;
    }
    
    public function getName()
    {
        return 'webpack_assets';
    }

    /**
     * @param string $bundle
     * @param string $type
     *
     * @return string
     */
    public function getUrl($bundle, $type='js')
    {
        return $this->assetHelper->getAssetUrl($bundle, $type);
    }
}
