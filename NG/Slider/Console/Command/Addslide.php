<?php
namespace NG\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use NG\Slider\Model\SlideFactory;
use Magento\Framework\Console\Cli;
class Addslide extends Command{
    const  INPUT_KEY_IMAGE = "image_url";
    const  INPUT_KEY_DESCRIPTION = "description";
    const  INPUT_KEY_POSITION = "position";
    const  INPUT_KEY_STATUS = "status";

    private $slideFactory;

    public function __construct(SlideFactory $slideFactory)
    {
        $this->slideFactory = $slideFactory;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setName("ng:slide:add")
            ->addArgument(
                self::INPUT_KEY_IMAGE,
                InputArgument::REQUIRED,
                "Slide Image Url"
            )->addArgument(
                self::INPUT_KEY_DESCRIPTION,
                InputArgument::OPTIONAL,
                "Description for slide if any"
            )->addArgument(
                self::INPUT_KEY_POSITION,
                InputArgument::OPTIONAL,
                "position for slide"
            )->addArgument(
                self::INPUT_KEY_STATUS
            );
        $this->setDescription('Command to add slide for NG Slider');
        parent::configure();
    }

    protected function execute(InputInterface $input , OutputInterface $output){
        $slide = $this->slideFactory->create();
        $slide->setImageUrl($input->getArgument(self::INPUT_KEY_IMAGE));
        $slide->setDescription($input->getArgument(self::INPUT_KEY_DESCRIPTION));
        $slide->setPosition($input->getArgument(self::INPUT_KEY_POSITION));
        $slide->setStatus($input->getArgument(self::INPUT_KEY_STATUS));
        $slide->setIsObjectNew(true);
        $slide->save();
        return Cli::RETURN_SUCCESS;
    }

}