<?php

/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Block;

use Magento\Framework\View\Element\Template;
use NG\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;
use Magento\Framework\Image\AdapterFactory;
use NG\Slider\Model\Config;

class Slide extends Template
{
    protected $config;
    protected $imageFactory;
    protected $fileSystem;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Config $config,
        AdapterFactory $imageFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
        $this->imageFactory = $imageFactory;
        $this->fileSystem = $context->getFilesystem();
        parent::__construct($context, $data);
    }

    /**
     * @return \NG\Slider\Model\Slide[]
     */
    public function getSlides()
    {
        $result = $this->collectionFactory->create()->addFilter('status', 1)
            ->setOrder('position', 'ASC')
            ->getItems();
        return $result;
    }

    /**
     * @param $configName
     */
    public function getConfigValue($configName)
    {
        return $this->config->getConfigValue($configName);
    }

    // pass image Name, width and height

    /**
     * @param $image
     * @param null $width
     * @param null $height
     * @return string
     * @throws \Exception
     */
    public function resize($image, $width = null, $height = null)
    {

        $absolutePath = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath().$image;
        $imageResized = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath().$image;
        //create image factory...
        $imageResize = $this->imageFactory->create();
        $imageResize->open($absolutePath);
        $imageResize->constrainOnly(TRUE);
        $imageResize->keepTransparency(TRUE);
        $imageResize->keepFrame(FALSE);
        $imageResize->keepAspectRatio(FALSE);
        $imageResize->resize($width, $height);
        //destination folder
        $destination = $imageResized ;
        //save image
        $imageResize->save($destination);

        $resizedURL = $this->_storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA
        ) . 'resized/'.$width.'/'.$image;
        return $resizedURL;
    }
}
