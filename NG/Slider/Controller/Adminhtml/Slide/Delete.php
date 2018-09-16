<?php

 /*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use NG\Slider\Model\Slide;

class Delete extends Action
{

    protected $model;

    public function __construct(Action\Context $context, Slide $model)
    {
        $this->model = $model;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NG_Slider::delete');
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->model;
                /** @var TYPE_NAME $id */
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The Slide has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a slide to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
