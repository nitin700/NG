<?php
namespace NG\Slider\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result; */

        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        //$result->setContents('Hello Nitin');
        //echo "<pre>"; print_r($result); exit;
        return $result;
    }
}