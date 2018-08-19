<?php

namespace NG\Slider\Model\Config;
use Magento\Framework\Option\ArrayInterface;
class Options implements ArrayInterface
{

    const TRUE_ENABLE = 'true';
    const FALSE_DISABLED = 'false';


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
        return [self::TRUE_ENABLE => __('True'), self::FALSE_DISABLED => __('False')];
    }
}