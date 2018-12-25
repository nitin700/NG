<?php

 /*
 * NG_Slider
 * @category   Banner Slider
 * @package    NG_Slider
 * @license    OSL-v3.0
 * @version    1.0.0
 */
 
namespace NG\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\App\Filesystem\DirectoryList;
use NG\Slider\Model\Slide;

class Save extends Action
{
    protected $mediaDirectory;
    protected $fileUploaderFactory;
    protected $newFileName;
    protected $slidesFolderPath;
    protected $file;
    protected $session;
    protected $allowedExt = ['jpg', 'png', 'jpeg'];

    /*
     * Save constructor.
     * @param Action\Context $context
     * @param Filesystem $fileSystem
     * @param UploaderFactory $uploaderFactory
     * @param File $file
     * @param Session $session
     * @param Slide $model
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Action\Context $context,
        Filesystem $fileSystem,
        UploaderFactory $uploaderFactory,
        File $file,
        Slide $model
    ) {
        $this->mediaDirectory = $fileSystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->fileUploaderFactory = $uploaderFactory;
        $this->slidesFolderPath = "NG_Slider/";
        $this->file = $file;
        $this->session = $context->getSession();
        $this->model = $model;
        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface
     * \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $fileExist = $this->getRequest()->getFiles('image')['tmp_name'];
        if ($data) {
            $model = $this->model;
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            };
            /*
             * below code to manage unsupported image extension
             */
            if ($fileExist && !empty($fileExist)) {
                $uploader = $this->fileUploaderFactory->create(['fileId' => 'image']);
                $uploadedExt = $uploader->getFileExtension();
                if (!in_array($uploadedExt, $this->allowedExt)) {
                    $this->messageManager->addError("Invalid File Upload...");
                    if ($id) {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                    } else {
                        return $resultRedirect->setPath('*/*/');
                    }
                }
            }
            //#################################################
            try {
                $target = $this->mediaDirectory->getAbsolutePath();
                if (isset($data['image']['delete']) && $data['image']['delete']==1) {
                    if ($fileExist && !empty($fileExist)) {
                        $fileName = $data['image']['value'];
                        if ($this->file->isExists($target . $fileName)) {
                            $this->file->deleteFile($target . $fileName);
                        }
                    } else {
                        $this->messageManager->addError("Can not delete existing image, without uploading new one...");
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                    }
                }
                // file upload to media folder
                if ($fileExist && !empty($fileExist)) {
                    $uploader->setAllowedExtensions(['jpg', 'png', 'jpeg']);
                    $uploader->setAllowRenameFiles(true);
                    $this->newFileName = 'ngSlide_' . time() . '.' . $uploadedExt;
                    $target = $target . $this->slidesFolderPath;
                    $uploader->save($target, $this->newFileName);
                    $data['image'] = $this->slidesFolderPath . $this->newFileName;
                } else {
                    $data['image'] = $data['image']['value'];
                }
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccess(__('Data has been successfully saved.'));
                $this->session->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        'ng_slider/slide/edit',
                        ['id' => $model->getId(),
                        '_current' => false]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong, unable to save data'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

     /*
     * @return string
     */
    public function getDestinationPath()
    {
        return $pathurl = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ) . 'NG_Slider/';
    }
}
