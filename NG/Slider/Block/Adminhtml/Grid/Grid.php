<?php

/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block\Adminhtml\Grid;

use Magento\Backend\Block\Widget\Grid\Extended;

class Grid extends Extended
{
    protected $moduleManager;
    protected $gridFactory;
    protected $status;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \NG\Slider\Model\SlideFactory $gridFactory,
        \NG\Slider\Model\Config\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->gridFactory = $gridFactory;
        $this->status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }
   
    protected function _construct()
    {
        parent::_construct();
        $this->setId('gridGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('grid_record');
    }
   
    protected function _prepareCollection()
    {
        $collection = $this->gridFactory->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareColumns()
    {
         $this->addColumn(
             'id',
             [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'filter' => false,
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
             ]
         );
        $this->addColumn(
            'image',
            [
                'header' => __('Image'),
                'type' => 'image',
                'index' => 'image',
                'class' => 'xxx',
                'filter' => false,
                'renderer' => 'NG\Slider\Block\Adminhtml\Thumbnail'
            ]
        );

        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'index' => 'position',
                'filter' => false,
                'class' => 'xxx'
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'class' => 'xxx',
                'type' => 'options',
                'options' => $this->status->getOptionArray()
            ]
        );
 
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'ngslider/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
 
        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'ngslider/*/delete'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');
        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('ngslider/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );
        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('ngslider/*/grid', ['_current' => true]);
    }

    public function getRowUrl($row)
    {
        return false;
    }
}
