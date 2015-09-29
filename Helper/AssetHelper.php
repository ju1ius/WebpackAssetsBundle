<?php

namespace ju1ius\WebpackAssetsBundle\Helper;

/**
 * @author ju1ius
 */
class AssetHelper
{
    /**
     * Path to the JSON revision manifest supplied to wepback's AssetPlugin
     *
     * @var string
     */
    private $manifestPath;

    /**
     * Cached contents of the JSON manifest.
     *
     * @var array
     */
    private $manifest;

    public function __construct($manifestPath)
    {
        $this->manifestPath = $manifestPath;
    }

    public function getAssetUrl($bundle, $type='js')
    {
        $publicPath = $this->getAssetVersion($bundle, $type);

        return $publicPath;
    }

    public function getAssetVersion($bundle, $type='js')
    {
        $this->loadManifest();

        if (!isset($this->manifest[$bundle])) {
            throw new \RuntimeException(sprintf('No bundle "%s" in the version manifest!', $bundle));
        }
        if (!isset($this->manifest[$bundle][$type])) {
            throw new \RuntimeException(sprintf(
                'No type "%s" for bundle "%s" in the version manifest!',
                $type,
                $bundle
            ));
        }

        return $this->manifest[$bundle][$type];
    }

    private function loadManifest()
    {
        if ($this->manifest) {
            return;
        }
        if (!file_exists($this->manifestPath)) {
            throw new \RuntimeException(sprintf('Cannot find manifest file: "%s"', $this->manifestPath));
        }
        $this->manifest = json_decode(file_get_contents($this->manifestPath), true);
    }
}
