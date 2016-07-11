<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * NpCloudinary_AssetMapper Model
 *
 * @author    Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link      https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since     0.0.1
 */

namespace Craft;

class NpCloudinary_AssetMapperModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'someField'     => array(AttributeType::String, 'default' => 'some value'),
        ));
    }

}