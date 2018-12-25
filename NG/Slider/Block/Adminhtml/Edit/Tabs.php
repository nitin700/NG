<?php
 /*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block\Adminhtml\Edit;

use \Magento\Backend\Block\Widget\Tabs as DefaultTabs;

class Tabs extends DefaultTabs
{

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
        try {
            $this->addTab(
                'slide_info',
                [
                    'label' => __('General'),
                    'title' => __('General'),
                    'active' => true
                ]
            );
        } catch (\Exception $e) {
            return $e;
        }
    }
}
