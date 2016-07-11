<?php
namespace Craft;

class NpCloudinary_AdminController extends BaseController
{
	public function actionCloudinarificateAssets()
	{
		$this->requireAdmin();

		// Get all assets
		$criteria = craft()->elements->getCriteria(ElementType::Asset);
		$assetIds = $criteria->ids();

		if (!empty($assetIds)) {
			craft()->tasks->createTask('NpCloudinary_AddAssets', 'Add assets to Cloudinary', array(
				'assetIds' => $assetIds,
			));
		}

		craft()->userSession->setFlash('notice', Craft::t('Assets-Cloudinarification task created ..'));
		$this->redirect(craft()->request->getUrlReferrer());
	}
}
