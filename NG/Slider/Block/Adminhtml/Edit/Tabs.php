<?php
namespace NG\Slider\Block\Adminhtml\Edit;
use \Magento\Backend\Block\Widget\Tabs as DefaultTabs;
use Magento\Framework\Exception\LocalizedException;

class Tabs extends DefaultTabs{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Slide Information'));
        $this->addTab(
            'slide_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                /*'content' => $this->getLayout()->createBlock(
                    'NG\Slider\Block\Adminhtml\Edit'
                )->toHtml(),*/
                'active' => true
            ]
        );
    }

}