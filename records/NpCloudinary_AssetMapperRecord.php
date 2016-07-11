<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * NpCloudinary_AssetMapper Record
 *
 * @author    Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link      https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since     0.0.1
 */

namespace Craft;

class NpCloudinary_AssetMapperRecord extends BaseRecord
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 'npcloudinary_AssetMapper';
    }

    /**
     * @access protected
     * @return array
     */
   protected function defineAttributes()
    {
        return array(
            'someField'     => array(AttributeType::String, 'default' => ''),
        );
    }

    /**
     * @return array
     */
    public function defineRelations()
    {
        return array(
        );
    }
}