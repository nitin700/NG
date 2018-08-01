<?php

namespace NG\Slider\Model;
use Magento\Framework\Option\ArrayInterface;
class Status implements ArrayInterface
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;


    public function toOptionArray()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }



}