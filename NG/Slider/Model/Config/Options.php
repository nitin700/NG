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

class Options implements ArrayInterface
{
    const TRUE_ENABLE = 'true';
    const FALSE_DISABLED = 'false';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        foreach (self::getOptionArray() as $index => $value) {
            $result[$index] = $value;
        }
        return $result;
    }

    /**
     * @return array
     */
    public static function getOptionArray()
    {
        return [self::TRUE_ENABLE => __('True'), self::FALSE_DISABLED => __('False')];
    }
}
