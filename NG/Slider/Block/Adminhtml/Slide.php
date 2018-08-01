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
}