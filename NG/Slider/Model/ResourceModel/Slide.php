<?php

namespace NG\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Slide extends AbstractDb{

    /**
     * protected function to initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('ng_slider','id');
    }
}