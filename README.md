# NP Cloudinary plugin for Craft CMS


A simple way to let Craft CMS and Cloudinary interact.

## Installation

To install NP Cloudinary, follow these steps:

1. Download & unzip the file and place the `npcloudinary` directory into your `craft/plugins` directory and run `composer update` from the plugin's folder.
2.  -OR- do a `git clone https://github.com/nilsenpaul/npcloudinary.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`. After that, run `composer update` from the plugin's folder.
3.  -OR- install with Composer via `composer require nilsenpaul/npcloudinary`
5. Install plugin in the Craft Control Panel under Settings > Plugins
6. The plugin folder should be named `npcloudinary` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

NP Cloudinary works on Craft 2.4.x and Craft 2.5.x, with PHP >= 5.4.x.

## NP Cloudinary Overview

This plugin lets you use Cloudinary's advanced image magic from within your Craft CMS Twig templates.

## Configuring NP Cloudinary

Just add your Cloudinary Api key, secret and Cloud name to this plugin's settings.

## Using NP Cloudinary

This plugin uploads (copies) your assets to your Cloudinary account, on upload. If you want it to, it will also delete the files whenever you do so in Craft CMS.
To show one of your assets from a template, use the plugin's variable.

    {% set asset = craft.assets.id(95).first() %}
    {{ craft.npcloudinary.img(asset, {
        responsive: true,
        width: 'auto',
        height: 325,
        crop: 'fill',
        gravity: 'auto',
        quality: 'auto',
        fetch_format: 'auto',
    }) | raw }}

All options are passed to Cloudinary's API.
If you want to use Cloudinary's responsive features, be sure to add:

    <meta http-equiv="Accept-CH" content="DPR, Viewport-Width, Width"> 

... to your header.

## NP Cloudinary Changelog

### 1.0.0 -- 2016.07.13

* Initial release
