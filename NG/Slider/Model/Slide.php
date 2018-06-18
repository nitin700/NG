<?php
namespace NG\Slider\Model;

use Magento\Framework\Model\AbstractModel;
//use NG\Slider\Model\ResourceModel\Slide as ResourceSlide;
class Slide extends AbstractModel{
    /**
     *
     */
    protected function _construct()
    {
       $this->_init(\NG\Slider\Model\ResourceModel\Slide::class );
    }
}