<?php

 /*
 * NG_Slider
 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private $optionArray = [
        'isModuleEnabled'=>'slider/general/enabled',
        'mode'=>'slider/settings/transitionMode',
        'speed'=>'slider/settings/transitionSpeed',
        'captions'=>'slider/settings/captions',
        'controls'=>'slider/settings/controls',
        'autoControls'=>'slider/settings/autoControls',
        'autoControlsCombine'=>'slider/settings/autoControlsCombine',
        'auto'=>'slider/settings/auto',
        'autoStart'=>'slider/settings/autoStart',
        'isResizeEnable'=>'slider/resizeimage/enable',
        'width'=>'slider/resizeimage/width',
        'height'=>'slider/resizeimage/height'
    ];

    private $config;

    /**
     * @return mixed
     */
    public function __construct(ScopeConfigInterface $config)
    {
        return $this->config = $config;
    }

    /**
     * @param $configName
     * @return string
     */
    public function getConfigValue($configName)
    {
        return $this->config->getValue($this->optionArray[$configName]);
    }
}
