<?php

 /*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Model\ResourceModel\Slide;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use NG\Slider\Model\Slide;
use NG\Slider\Model\ResourceModel\Slide as SlideResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Slide::class, SlideResource::class);
    }
}
