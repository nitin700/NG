<?php

/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Backend\Block\Context;
use Magento\Framework\UrlInterface;

class Thumbnail extends AbstractRenderer
{
    private $storeManager;

    /**
     * @param \Magento\Backend\Block\Context $context
     * @param array $data
     */
    public function __construct(Context $context, StoreManagerInterface $storemanager, array $data = [])
    {
        $this->storeManager = $storemanager;
        parent::__construct($context, $data);
        $this->_authorization = $context->getAuthorization();
    }

    /**
     * Renders grid column
     *
     * @param Object $row
     * @return  string
     */
    public function render(DataObject $row)
    {
        $mediaDirectory = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaDirectory.$this->_getValue($row);
        return '<img src="'.$imageUrl.'" width="150"/>';
    }
}
