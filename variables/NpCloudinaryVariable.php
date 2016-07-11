<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * NP Cloudinary Variable
 *
 * @author    Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link      https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since     0.0.1
 */

namespace Craft;

class NpCloudinaryVariable
{
    public function link(AssetFileModel $asset, $options = [])
    {
        return craft()->npCloudinary_cloudinary->getAssetUrl($asset, $options);
    }

    public function img(AssetFileModel $asset, $options = [])
    {
        return craft()->npCloudinary_cloudinary->getAssetTag($asset, $options);
    }

}
