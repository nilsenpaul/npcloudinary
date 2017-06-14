<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * To be inserted.
 *
 * @author	Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link	  https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since	 1.0.0
 */

namespace Craft;

class NpCloudinaryPlugin extends BasePlugin
{
	/**
	 * @return mixed
	 */
	public function init()
	{
		require_once craft()->path->getPluginsPath().'npcloudinary/vendor/autoload.php';
		$settings = craft()->plugins->getPlugin('npCloudinary')->getSettings();

		if (
			!craft()->request->post
			&& (
				$settings['cloudName'] == ''
				|| $settings['apiKey'] == ''
				|| $settings['apiSecret'] == ''
			)
		) {
			craft()->userSession->setFlash('error', Craft::t('To use NP Cloudinary, please set your API credentials first!'));	
		} else {
			\Cloudinary::config([
				'cloud_name' => $settings['cloudName'], 
				'api_key' => $settings['apiKey'], 
				'api_secret' => $settings['apiSecret'], 
			]);

			craft()->on('assets.saveAsset', function(Event $event) {
				craft()->npCloudinary_cloudinary->uploadAsset($event->params['asset']);
			});

			craft()->on('assets.deleteAsset', function(Event $event) {
				craft()->npCloudinary_cloudinary->deleteAsset($event);
			});
		}
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		 return Craft::t('NP Cloudinary');
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return Craft::t('Lets Craft CMS and Cloudinary play together');
	}

	/**
	 * @return string
	 */
	public function getDocumentationUrl()
	{
		return 'https://github.com/nilsenpaul/npcloudinary/npcloudinary/blob/master/README.md';
	}

	/**
	 * @return string
	 */
	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/nilsenpaul/npcloudinary/master/releases.json';
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '1.0.0';
	}

	/**
	 * @return string
	 */
	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return 'Paul Verheul for Nils & Paul';
	}

	/**
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'https://www.nilsenpaul.nl';
	}

	/**
	 * @return bool
	 */
	public function hasCpSection()
	{
		return false;
	}

	/**
	 * @return mixed
	 */
	public function addTwigExtension()
	{
		Craft::import('plugins.npcloudinary.twigextensions.NpCloudinaryTwigExtension');

		return new NpCloudinaryTwigExtension();
	}

	/**
	 */
	public function onBeforeInstall()
	{
	}

	/**
	 */
	public function onAfterInstall()
	{
	}

	/**
	 */
	public function onBeforeUninstall()
	{
	}

	/**
	 */
	public function onAfterUninstall()
	{
	}

	/**
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'cloudName' => array(AttributeType::String, 'label' => 'Cloudinary Cloud name', 'default' => ''),
			'apiKey' => array(AttributeType::String, 'label' => 'Cloudinary API key', 'default' => ''),
			'apiSecret' => array(AttributeType::String, 'label' => 'Cloudinary API secret', 'default' => ''),
			'removeIfDeleted' => array(AttributeType::Bool, 'label' => 'Remove if deleted', 'default' => ''),
		);
	}

	/**
	 * @return mixed
	 */
	public function getSettingsHtml()
	{
	   return craft()->templates->render('npcloudinary/NpCloudinary_Settings', array(
		   'settings' => $this->getSettings()
	   ));
	}

	/**
	 * @return mixed
	 */
	public function prepSettings($settings)
	{
		// Modify $settings here...
		return $settings;
	}
}
