<?php
namespace NG\Slider\Model\ResourceModel\Slide;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use NG\Slider\Model\Slide;
use NG\Slider\Model\ResourceModel\Slide as SlideResource;
class Collection extends AbstractCollection{
    protected $_idFieldName = 'id';

    /**
     * Slide is a Model class.
     * SlideResource is a Resource model class for collection
     */
    protected function _construct()
    {
       $this->_init(
           Slide::class,
           SlideResource::class
       );
    }
}