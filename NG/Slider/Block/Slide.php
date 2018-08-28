<?php
namespace NG\Slider\Block;

use Magento\Framework\View\Element\Template;
use NG\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use NG\Slider\Model\Config;
use Magento\Framework\Image\AdapterFactory;
class Slide extends Template{
    protected $config;
    protected $_imageFactory;
    protected $_fileSystem;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Filesystem $fileSystem,
        Config $config,
        AdapterFactory $imageFactory,
        array $data = [])
    {
       $this->collectionFactory = $collectionFactory;
        $this->config = $config;
        $this->_imageFactory = $imageFactory;
        $this->_fileSystem = $fileSystem;
       parent::__construct($context, $data);
    }

    /**
     * @return \NG\Slider\Model\Slide[]
     */
    public function getSlides(){
        $result = $this->collectionFactory->create()->addFilter('status',1)
            ->setOrder('position','ASC')
            ->getItems();
        return $result;
    }

    /**
     * @param $configName
     */
    public function getConfigValue($configName){
        return $this->config->getConfigValue($configName);
    }

    // pass image Name, width and height
    public function resize($image, $width = null, $height = null)
    {
        //$absolutePath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('helloworld/images/').$image; //complete path of image
        $absolutePath = $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath().$image;

        $imageResized = $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath().$image;
        //create image factory...
        $imageResize = $this->_imageFactory->create();
        $imageResize->open($absolutePath);
        $imageResize->constrainOnly(TRUE);
        $imageResize->keepTransparency(TRUE);
        $imageResize->keepFrame(FALSE);
        $imageResize->keepAspectRatio(FALSE);
        $imageResize->resize($width,$height);
        //destination folder
        $destination = $imageResized ;
        //save image
        $imageResize->save($destination);

        $resizedURL = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'resized/'.$width.'/'.$image;
        return $resizedURL;
    }
}