<?php

namespace NG\Slider\Controller\Adminhtml\Slide;
use Magento\Backend\App\Action;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
class Save extends Action{

    protected $_mediaDirectory;
    protected $_fileUploaderFactory;
    protected $_newFileName;
    protected $_slidesFolderPath;
    protected $_file;


    /**
     * Save constructor.
     * @param Action\Context $context
     */
    public function __construct(
        Action\Context $context,
        Filesystem $fileSystem,
        UploaderFactory $uploaderFactory,
        File $file
    )
    {
        /** @var TYPE_NAME $filesystem */
        $this->_mediaDirectory = $fileSystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $uploaderFactory;
        $this->_slidesFolderPath = "NG_Slider/";
        $this->_file = $file;
        parent::__construct($context);
    }

    public function execute() {
    /** @var TYPE_NAME $data */
    $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->_objectManager->create('NG\Slider\Model\Slide');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            try {
                $fileExist = $this->getRequest()->getFiles('image')['tmp_name'];
                $target = $this->_mediaDirectory->getAbsolutePath();
                if(isset($data['image']['delete']) AND $data['image']['delete']==1){
                    $fileName = $data['image']['value'];
                    if ($this->_file->isExists($target . $fileName))  {
                        $this->_file->deleteFile($target . $fileName);
                    }
                }

                // file upload to media folder
                if($fileExist AND !empty($fileExist)) {

                    $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'png', 'jpeg']);
                    $uploader->setAllowRenameFiles(true);
                    $this->_newFileName = 'ngSlide_' . time() . '.' . $uploader->getFileExtension();
                    $target = $target . $this->_slidesFolderPath;
                    $uploader->save($target, $this->_newFileName);
                    $data['image'] = $this->_slidesFolderPath . $this->_newFileName;
                } else{
                    $data['image'] = $data['image']['value'];
                }
                //echo "<pre>"; print_r($data); exit;
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccess(__('Data has been successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                $resultRedirect = $this->resultRedirectFactory->create();
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('ng_slider/slide/edit',['id' => $model->getId(), '_current' => false]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function getDestinationPath()
    {
        return $pathurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'NG_Slider/';
    }
}