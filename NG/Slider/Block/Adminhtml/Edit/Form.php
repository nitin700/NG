<?php

/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block\Adminhtml\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Widget\Form\Generic;
use NG\Slider\Model\Config\Status;

/**
 * Adminhtml  edit form
 */

class Form extends Generic
{
    protected $status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Status $status,
        array $data = []
    ) {
        $this->status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('slide_form');
        $this->setTitle(__('Slide Information'));
    }

    /**
     * Prepare form
     *
     * @return \Exception|LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \NG\Slider\Model\Slide $model */
        $model = $this->_coreRegistry->registry('slider_slide');

        /** @var \Magento\Framework\Data\Form $form */
        try {
            $form = $this->_formFactory->create(
                [
                    'data' => [
                        'id' => 'edit_form',
                        'action' => $this->getData('action'),
                        'method' => 'post',
                        'enctype' => 'multipart/form-data'
                    ]
                ]
            );
        } catch (LocalizedException $e) {
            return $e;
        }

        $form->setHtmlIdPrefix('ngslide_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'image',
            'image',
            [
                'title' => __('Image'),
                'label' => __('Image'),
                'name' => 'image',
                'note' => 'Allow image type: jpg, jpeg, png',
                'required' => true
            ]
        )->setAfterElementHtml('
        <script>
            require([
                 "jquery"
            ], function($){
                $(document).ready(function () {
                    if($("#ngslide_image").attr("value")){
                        $("#ngslide_image").removeClass("required-file");
                    }else{
                        $("#ngslide_image").addClass("required-file");
                    }
                    $( "#ngslide_image" ).attr( "accept","image/x-png,image/jpeg,image/jpg,image/png" );
                });
              });
       </script>');
        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'required' => false,
                'note' => __('any description to display on slide')
            ]
        );
        $fieldset->addField(
            'url',
            'text',
            [
                'name' => 'url',
                'label' => __('Link'),
                'title' => __('Link'),
                'required' => false,
                'note' => __('Link')
            ]
        );
        $fieldset->addField(
            'position',
            'text',
            [
                'name' => 'position',
                'label' => __('position'),
                'title' => __('position'),
                'required' => false,
                'class' => 'validate-number'
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => $this->status->toOptionArray(),
                'note' => __('Select enable to activate slide')
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
