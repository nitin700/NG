<?php
/**
 ** This file is to get configuration for module.
 **/
namespace NG\Slider\Model;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Config{
	private $optionArray = array(
	                        'mode'=>'slider/settings/transitionMode',
							'speed'=>'slider/settings/transitionSpeed',
							'captions'=>'slider/settings/captions',
							'controls'=>'slider/settings/controls',
							'autoControls'=>'slider/settings/autoControls',
							'autoControlsCombine'=>'slider/settings/autoControlsCombine',
							'auto'=>'slider/settings/auto',
							'autoStart'=>'slider/settings/autoStart',
	                        );
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
    /**
     * @param $configName
     */
    public function getConfigValue($configName){
        switch ($configName){
            case "mode":
                echo $this->config->getValue($this->optionArray[$configName]);
                break;
            case "speed":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "captions":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "controls":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "autoControls":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "autoControlsCombine":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "auto":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            case "autoStart":
                return $this->config->getValue($this->optionArray[$configName]);
                break;
            default:
                return false;
        }
    }
}