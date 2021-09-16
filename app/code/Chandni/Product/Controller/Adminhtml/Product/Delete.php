<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Controller\Adminhtml\Product;

class Delete extends \Chandni\Product\Controller\Adminhtml\Product
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        
        $resultRedirect = $this->resultRedirectFactory->create();
        
        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Chandni\Product\Model\Product::class);
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccessMessage(__('You deleted the Data.'));
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                
                $this->messageManager->addErrorMessage($e->getMessage());
                
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        
        $this->messageManager->addErrorMessage(__('We can\'t find a Data to delete.'));
        
        return $resultRedirect->setPath('*/*/');
    }
}

