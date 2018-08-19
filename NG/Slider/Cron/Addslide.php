<?php
namespace NG\Slider\Cron;

use NG\Slider\Model\Config;
use NG\Slider\Model\SlideFactory;

class Addslide
{
    private $slideFactory;
    private $config;
    public function __construct(SlideFactory $slideFactory, Config $config)
    {
        $this->slideFactory = $slideFactory;
        $this->config = $config;
    }

    public function execute(){
        if($this->config->isEnabled()) {
            $slide = $this->slideFactory->create();
            $slide->setImageUrl("image url nitin");
            $slide->setDescription("description nitin");
            $slide->setPosition(15);
            $slide->setStatus(1);
            $slide->save();
        }
    }
}