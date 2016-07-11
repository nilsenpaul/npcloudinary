<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * NP Cloudinary Twig Extension
 *
 * @author    Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link      https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since     0.0.1
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class NpCloudinaryTwigExtension extends \Twig_Extension
{
    /**
     * @return string The extension name
     */
    public function getName()
    {
        return 'NpCloudinary';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'someFilter' => new \Twig_Filter_Method($this, 'someInternalFunction'),
        );
    }

    /**
    * @return array
     */
    public function getFunctions()
    {
        return array(
            'someFunction' => new \Twig_Function_Method($this, 'someInternalFunction'),
        );
    }

    /**
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }
}