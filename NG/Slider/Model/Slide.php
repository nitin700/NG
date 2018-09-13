<?php
/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Model;

class Slide extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('NG\Slider\Model\ResourceModel\Slide');
    }


}