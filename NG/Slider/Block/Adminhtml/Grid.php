<?php

/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Grid extends Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'NG_Slider';
        $this->_headerText = __('Manage Slides');
        $this->_addButtonLabel = __('Create New Slide');
        parent::_construct();
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('NG\Slider\Block\Adminhtml\Grid\Grid', 'grid.view.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * Create "New" button
     *
     * @return void
     */
    protected function _addNewButton()
    {
        $this->addButton(
            'add',
            [
                'label' => $this->getAddButtonLabel(),
                'onclick' => 'setLocation(\'' . $this->getCreateUrl() . '\')',
                'class' => 'add primary'
            ]
        );
    }

    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/newslide');
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
