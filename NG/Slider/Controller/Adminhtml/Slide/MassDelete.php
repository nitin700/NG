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
use NG\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends Action
{
    protected $collectionFactory;

     /*
     * MassDelete constructor.
     * @param Action\Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Action\Context $context, CollectionFactory $collectionFactory)
    {
     
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
   
    public function execute()
    {
        $deleteids = $this->getRequest()->getPost('id');
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('id', array('in'=>$deleteids));
        $delete = 0;
        foreach ($collection as $item) {
            $item->delete();
            $delete++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
