<?php
/**
 * NP Cloudinary plugin for Craft CMS
 *
 * NpCloudinary_Cloudinary Service
 *
 * @author    Paul Verheul for Nils &amp; Paul
 * @copyright Copyright (c) 2016 Paul Verheul for Nils &amp; Paul
 * @link      https://www.nilsenpaul.nl
 * @package   NpCloudinary
 * @since     0.0.1
 */

namespace Craft;

class NpCloudinary_CloudinaryService extends BaseApplicationComponent
{
    	public function uploadAsset(AssetFileModel $savedAsset)
    	{
		try {
			\Cloudinary\Uploader::upload($savedAsset->url, [
				'public_id' => $this->getAssetHandle($savedAsset),
			]);
		} catch (\Cloudinary\Error $e) {
			$this->handleError($e->getMessage());
		}
    	}

	public function deleteAsset(Event $event)
	{
		$settings = craft()->plugins->getPlugin('npCloudinary')->getSettings();

		if ($settings['removeIfDeleted']) {
			try {
				$api = new \Cloudinary\Api();
				$api->delete_resources([$this->getAssetHandle($event->params['asset'])]);
				return true;
			} catch(\Cloudinary\Error $e) {
				$this->handleError($e->getMessage());
			} catch(\Cloudinary\Api\AuthorizationRequired $e) {
				$this->handleError($e->getMessage());
			}
		}
	}

	public function getAssetUrl(AssetFileModel $asset, $options) 
	{
		$publicId = $this->getAssetHandle($asset);
		$url = cloudinary_url($publicId, $options);

		return $url;
	}

	public function getAssetTag(AssetFileModel $asset, $options)
	{
		$publicId = $this->getAssetHandle($asset);

		$this->includeJs();
		return cl_image_tag($publicId, $options);
	}

	protected function getAssetHandle(AssetFileModel $asset)
	{
		$filenameWithoutExtension = pathinfo($asset->filename, PATHINFO_FILENAME);

		return
			$asset->folder->name
			.'_'
			.$filenameWithoutExtension;
	}

	protected function handleError($error)
	{
		NpCloudinaryPlugin::log(Craft::t('Cloudinary error: ').$error, LogLevel::Error);
	}

	protected function includeJs()
	{
		$settings = craft()->plugins->getPlugin('npCloudinary')->getSettings();

		$cloudinaryResource = UrlHelper::getResourceUrl('npcloudinary/js/cloudinary-jquery.min.js');
		craft()->templates->includeJsFile($cloudinaryResource);
		craft()->templates->includeJs('$.cloudinary.config({ cloud_name: "'.$settings['cloudName'].'", api_key: "'.$settings['apiKey'].'"});');
		craft()->templates->includeJs('$.cloudinary.responsive();');
	}
}
