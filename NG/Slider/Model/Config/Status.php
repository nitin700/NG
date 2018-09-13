<?php
/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;


    public function toOptionArray()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[$index] = $value;
        }
        return $result;
    }

    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Active'), self::STATUS_DISABLED => __('Deactive')];
    }

}