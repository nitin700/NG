<?php
namespace NG\Slider\Model;
class Slide extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('NG\Slider\Model\ResourceModel\Slide');
    }


}