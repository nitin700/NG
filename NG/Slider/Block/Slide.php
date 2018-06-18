<?php
namespace NG\Slider\Block;

use Magento\Framework\View\Element\Template;
use NG\Slider\Model\ResourceModel\Slide\Collection;
use NG\Slider\Model\ResourceModel\Slide\CollectionFactory;

class Slide extends Template{

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = [])
    {
       $this->collectionFactory = $collectionFactory;
       parent::__construct($context, $data);
    }

    /**
     * @return \NG\Slider\Model\Slide[]
     */
    public function getSlides(){
        return $this->collectionFactory->create()->getItems();
    }
}