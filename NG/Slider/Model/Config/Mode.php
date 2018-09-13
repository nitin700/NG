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

class Mode implements ArrayInterface
{

    const MODE_HORIZONTAL = 'horizontal';
    const MODE_VERTICAL = 'vertical';
    const MODE_FADE = 'fade';


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
        return [self::MODE_HORIZONTAL => __('HORIZONTAL'), self::MODE_VERTICAL => __('VERTICAL'), self::MODE_FADE => __('FADE')];
    }
}