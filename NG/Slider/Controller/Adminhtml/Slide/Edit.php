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
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use NG\Slider\Model\Slide;

class Edit extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;
    protected $resultPageFactory;
    protected $session;
    protected $_publicActions = ['edit'];

    /*
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param Session $session
     * @param Slide $model
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Slide $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->session = $context->getSession();
        $this->model = $model;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NG_Slider::save');
    }
    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
         /**
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * Edit Staff
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
         $id = $this->getRequest()->getParam('id');
         /**
         * @var \NG\Slider\Model\Slide $model
         */
        $model = $this->model;
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Slide does not exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->coreRegistry->register('slider_slide', $model);

         /**
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Slide') : __('New Slide'),
            $id ? __('Edit Slide') : __('New Slide')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Slider Slide'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Slide'));
        return $resultPage;
    }
}
