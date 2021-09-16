<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Chandni\Product\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterfaceFactory;
use Magento\Catalog\Helper\Image;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class ProductDisclaimer extends Template
{
    const XML_CHANDNI_PRODUCT_GENERAL_PRODUCT_DISCLAIMER = "chandniproduct/chandni_general/product_disclaimer";

    /**
     * SideImage constructor.
     * @param Template\Context $context
     * @param ProductRepositoryInterfaceFactory $productRepositoryFactory
     * @param Image $imageHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ){
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function getProductDisclamier() {
        return $this->_scopeConfig->getValue(self::XML_CHANDNI_PRODUCT_GENERAL_PRODUCT_DISCLAIMER, ScopeInterface::SCOPE_STORE);
    }
}
