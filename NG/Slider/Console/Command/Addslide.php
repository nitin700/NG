<?php
/*
 * NG_Slider

 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */

namespace NG\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use NG\Slider\Model\SlideFactory;
use Magento\Framework\Console\Cli;

class Addslide extends Command
{
    const  INPUT_KEY_IMAGE = "image";
    const  INPUT_KEY_DESCRIPTION = "description";
    const  INPUT_KEY_POSITION = "position";
    const  INPUT_KEY_LINK = "url";
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
                "Slide Image Url, e,g: NG_Slider/imageName"
            )->addArgument(
                self::INPUT_KEY_DESCRIPTION,
                InputArgument::OPTIONAL,
                "Description for slide to display in caption"
            )->addArgument(
                self::INPUT_KEY_POSITION,
                InputArgument::OPTIONAL,
                "position for slide"
            )->addArgument(
                self::INPUT_KEY_LINK,
                InputArgument::OPTIONAL,
                "Slide Target Url"
            )->addArgument(
                self::INPUT_KEY_STATUS,
                InputArgument::OPTIONAL,
                "1 = active 0 = deactive"
            );
        $this->setDescription('Command to add slide for NG Slider');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $slide = $this->slideFactory->create();
        $slide->setImage($input->getArgument(self::INPUT_KEY_IMAGE));
        $slide->setDescription($input->getArgument(self::INPUT_KEY_DESCRIPTION));
        $slide->setPosition($input->getArgument(self::INPUT_KEY_POSITION));
        $slide->setStatus($input->getArgument(self::INPUT_KEY_STATUS));
        $slide->setUrl($input->getArgument(self::INPUT_KEY_LINK));
        $slide->setIsObjectNew(true);
        $slide->save();
        return Cli::RETURN_SUCCESS;
    }
}
