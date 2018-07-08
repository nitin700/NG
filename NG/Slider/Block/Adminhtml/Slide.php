<?php
namespace NG\Slider\Block\Adminhtml;

class Slide extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'NG_Slider';
        $this->_headerText = __('Manage Slides');
        $this->_addButtonLabel = __('Create New Slide');
        parent::_construct();
    }
}