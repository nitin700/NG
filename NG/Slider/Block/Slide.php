<?php
namespace NG\Slider\Block;

use Magento\Framework\View\Element\Template;
use NG\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use NG\Slider\Model\Config;
class Slide extends Template{
    protected $_mediaDirectory;
    protected $config;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Filesystem $fileSystem,
        Config $config,
        array $data = [])
    {
       $this->collectionFactory = $collectionFactory;
        $this->config = $config;
        $this->_mediaDirectory = $fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
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

    public function getMediaUrl(){
       return $this->_mediaDirectory;
    }

    /**
     * @param $configName
     */
    public function getConfigValue($configName){
        return $this->config->getConfigValue($configName);
    }
}