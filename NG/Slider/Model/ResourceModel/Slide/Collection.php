<?php
namespace NG\Slider\Model\ResourceModel\Slide;
use NG\Slider\Model\Slide;
use NG\Slider\Model\ResourceModel\Slide as SlideResource;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Slide::class, SlideResource::class);
    }

}