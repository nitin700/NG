<?php
/**
 ** This file is to get configuration for module.
 **/
namespace NG\Slider\Model;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Config{
    const XML_PATH_ENABLED = 'slider/general/enabled';

    private $config;

    /**
     * @return mixed
     */
    public function __construct(ScopeConfigInterface $config)
    {
        return $this->config = $config;
    }
    public function isEnabled(){
        return $this->config->getValue(XML_PATH_ENABLED);
    }
}