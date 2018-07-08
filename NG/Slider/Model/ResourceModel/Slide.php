<?php
namespace NG\Slider\Model\ResourceModel;


class Slide extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('ng_slider', 'id');
    }

}