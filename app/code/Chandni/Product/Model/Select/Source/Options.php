<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Chandni\Product\Model\Select\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Options implements ArrayInterface
{
    protected $collectionFactory;

    private $logger;

    public function __construct(
        CollectionFactory $collectionFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->collection = $collectionFactory->create();
        $this->logger = $logger;
    }
    public function toOptionArray()
    {
        $options = [];

        $sellerModel = $this->collection->addFieldToSelect('sku');
        
        $options[] = array( 'label' => 'Please select', 'value' => ''  );

        if( $sellerModel->getSize() ){
            foreach ( $sellerModel  as $seller) {
                $options[] = array( 
                'label' => $seller->getData('sku') ,
                'value' => $seller->getData('sku')
                );
            }
        }

        return $options;
}
}  