<?php
namespace Craft;

class NpCloudinary_AddAssetsTask extends BaseTask
{
	/**
	 * Defines the settings.
	 *
	 * @access protected
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'assetIds' => AttributeType::Mixed,
		);
	}
	/**
	 * Returns the default description for this task.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return 'Adding asset(s) to Cloudinary';
	}
	/**
	 * Gets the total number of steps for this task.
	 *
	 * @return int
	 */
	public function getTotalSteps()
	{
		return 1;
	}
	/**
	 * Runs a task step.
	 *
	 * @param int $step
	 * @return bool
	 */
	public function runStep($step)
	{
		foreach ($this->getSettings()->assetIds as $assetId) {
			craft()->npCloudinary_cloudinary->uploadAsset(craft()->assets->getFileById($assetId));
		}

		return true;
	}
}
