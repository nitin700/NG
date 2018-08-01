<?php
namespace NG\Slider\Block\Adminhtml\Edit;

/**
 * Adminhtml  edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \NG\Slider\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
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
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \NG\Slider\Model\Slide $model */
        $model = $this->_coreRegistry->registry('slider_slide');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post', 'enctype' => 'multipart/form-data']]
        );

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
                'note' => 'Allow image type: jpg, jpeg, gif, png',
                'required' => true
            ]
        )->setAfterElementHtml('
        <script>
            require([
                 "jquery",
            ], function($){
                $(document).ready(function () {
                    if($("#ngslide_image").attr("value")){
                        $("#ngslide_image").removeClass("required-file");
                    }else{
                        $("#ngslide_image").addClass("required-file");
                    }
                    $( "#ngslide_image" ).attr( "accept", "image/x-png,image/jpeg,image/jpg,image/png" );
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
                'options' => $this->_status->toOptionArray(),
                'note' => __('Select enable to activate slide')
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}